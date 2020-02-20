@extends('profile.layout.main')
@section('custom-links')


<style>
    .script_tabs {
        background-image: unset;
        background-color: #2e2d4a;
    }

    .script_tabs>li {
        height: 50px;

    }

    .script_tabs>.nav-item .nav-link,
    .script_tabs>.nav-item .nav-link>i {
        color: white;
    }

    .abstract_textarea {
        resize: none;
    }

</style>
@endsection

@section('page-content')

<errormodal v-on:dis-miss-error-modal="Error.resetErrorModal()" v-if="Error.visible" v-bind="Error"></errormodal>
<subsuccess v-if="Success.visible" v-bind="Success" v-on:dis-miss-subsuccess-modal="Success.resetSuccessModal()"></subsuccess>
<div class="row">
    <div class="col-md-1 col-lg-1"></div>
    <div class="col-md-10 col-lg-10">
        @if (!$has_profile)
        <div class="card">
            <div class="card-header alert alert-danger">

                Incomplete profile

            </div>
            <div class="card-body">
                Please complete your profile first, before submitting a new paper
            </div>
            <div class="card-footer">
                <a href="/profile/details" class="btn btn-primary">Complete profile</a>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-header">

                New Submission
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <ul class="navbar-nav bg-gradient-secondary sidebar-dark script_tabs" id="accordionSidebar">



                            <!-- Nav Item - Dashboard -->
                            <li class="nav-item border-bottom-primary "
                            :class="{'bg-gradient-primary': submission_tabs.active_tab ===0 }">
                                <a class="nav-link" href="/" @click.prevent="setActiveSubmissionTab(0)">
                                    <i class="fas fa-fw fa-info"></i>
                                    <span>Manuscript information</span>
                                    <span class="badge badge-success float-right mr-2" v-if="Manuscript_data.hasManInfo()">
                                        <i class="fas fa-fw fa-check" style="color:white"></i>
                                    </span>
                                    <span class="badge badge-danger float-right mr-2" v-else>
                                        <i class="fas fa-fw fa-times" style="color:white"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item border-bottom-primary"
                            :class="{'bg-gradient-primary': submission_tabs.active_tab ===1 }">
                                <a class="nav-link" href="/" @click.prevent="setActiveSubmissionTab(1)">
                                    <i class="fas fa-fw fa-user"></i>
                                    <span>Author information</span>

                                    <span class="badge badge-success float-right mr-2" v-if="Manuscript_data.hasAuthor()">
                                        <i class="fas fa-fw fa-check" style="color:white"></i>
                                    </span>
                                    <span class="badge badge-danger float-right mr-2" v-else>
                                        <i class="fas fa-fw fa-times" style="color:white"></i>
                                    </span>
                                </a>
                                    
                            </li>
                            <li class="nav-item border-bottom-primary"
                            :class="{'bg-gradient-primary': submission_tabs.active_tab ===2 }">
                                <a class="nav-link" href="/" @click.prevent="setActiveSubmissionTab(2)">
                                    <i class="fas fa-fw fa-file"></i>
                                    <span>Uplaod files</span>

                                    <span class="badge badge-success float-right mr-2" v-if="Manuscript_data.hasManuscriptFiles()">
                                        <i class="fas fa-fw fa-check" style="color:white"></i>
                                    </span>
                                    <span class="badge badge-danger float-right mr-2" v-else>
                                        <i class="fas fa-fw fa-times" style="color:white"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item border-bottom-primary"
                            :class="{'bg-gradient-primary': submission_tabs.active_tab ===3 }">
                                <a class="nav-link" href="/" @click.prevent="setActiveSubmissionTab(3)">
                                    <i class="fas fa-fw fa-save"></i>
                                    <span>Review and submit</span>

                                    <span class="badge badge-success float-right mr-2" v-if="Manuscript_data.hasFilledAll()">
                                        <i class="fas fa-fw fa-check" style="color:white"></i>
                                    </span>
                                    <span class="badge badge-danger float-right mr-2" v-else>
                                        <i class="fas fa-fw fa-times" style="color:white"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-8 col-lg-8">
                        <div class="card pagination">
                            <div class="card-header">
                                <nav aria-label="Page navigation example ">
                                    <ul class="pagination justify-content-center ">

                                        <li class="page-item " :class="{'active': submission_tabs.active_tab ===0 }">
                                            <a class="page-link" href="#" @click.prevent="setActiveSubmissionTab(0)">1</a>
                                        </li>
                                        <li class="page-item" :class="{'active': submission_tabs.active_tab ===1 }">
                                            <a class="page-link" href="#" @click.prevent="setActiveSubmissionTab(1)">2</a>
                                        </li>
                                        <li class="page-item" :class="{'active': submission_tabs.active_tab ===2 }">
                                            <a class="page-link" href="#" @click.prevent="setActiveSubmissionTab(2)">3</a>
                                        </li>
                                        <li class="page-item" :class="{'active': submission_tabs.active_tab ===3 }">
                                            <a class="page-link" href="#" @click.prevent="setActiveSubmissionTab(3)">4</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="card-body">
                                <div class="card manuscript_information"  v-if="submission_tabs.active_tab === 0">
                                    <div class="card-header bg-gradient-primary" style="color:white">
                                        <i class="fas fa-fw fa-info"></i> Manuscript information
                                    </div>
                                    <div class="card-body">

                                        <form class="user">
                                            <div class="form-group ">

                                                <select name="manuscript_type" id="" class="form-control select " 
                                                v-model="Manuscript_data.manuscript_type">
                                                    <option value="-1" selected>Select Article Type</option>
                                                    <option value="0">Research Article</option>
                                                    <option value="1">Thesis Paper</option>
                                                    <option value="2">Review Article</option>
                                                    <option value="3">Short Communication</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputEmail"
                                                    placeholder="Enter your article title" v-model="Manuscript_data.manuscript_title">
                                            </div>
                                            <div class="form-group">
                                                <textarea type="text" rows=10 class="form-control abstract_textarea"
                                                    id="exampleInputEmail"  v-model="Manuscript_data.manuscript_abstract"
                                                    placeholder="Enter your article abstract"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputEmail"
                                                    placeholder="Enter your article keywords"
                                                    v-model="Manuscript_data.mansucript_keywords">
                                            </div>


                                            <hr>

                                        </form>

                                    </div>
                                </div>


                                <div class="card author_information" v-if="submission_tabs.active_tab === 1">
                                    <div class="card-header bg-gradient-primary" style="color:white">
                                        <i class="fas fa-fw fa-info"></i> Author information
                                        <button type="submit" class="btn float-right"
                                            :class="getAuthorClass()" @click.prevent="toggleAuthorForm()">
                                            @{{author_form.text}} 
                                        </button>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                              <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Institution</th>
                                                <th scope="col">Location</th>
                                                <th scope="col">Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(author, akey) in Manuscript_data.manuscript_authors" :key="akey">
                                                    <th scope="row">@{{akey+1}}</th>
                                                    <td>@{{author.first_name + author.second_name}}</td>
                                                    <td>@{{author.email}}</td>
                                                    <td>@{{author.institute}}</td>
                                                    <td>@{{author.location}}</td>
                                                    <td>
                                                        <button class="btn btn-danger" 
                                                        @click.prevent="deleteAuthor(author)"> - Delete </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-center" v-if="Manuscript_data.manuscript_authors.length === 0">
                                            <div class="alert alert-danger">
                                                You have not created any author yet
                                                <button class="btn btn-primary ml-2" @click.prevent="setAsOnlyAuthor()">
                                                     I am the only author
                                                </button>
                                            </div>
                                        </div>
                                        <form class="user" v-if="author_form.visible">
                                            <div class="form-group row">
                                                <div class="col-md-6 col-lg-6">
                                                    <input type="text" class="form-control" id="exampleInputEmail"
                                                    placeholder="Enter Author first name" 
                                                    @change.prevent="author_form.Author.resetError(0)"
                                                    :class="author_form.Author.hasError(0)"
                                                    v-model="author_form.Author.first_name">
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <input type="text" class="form-control" id="exampleInputEmail"
                                                    placeholder="Enter Author second name"
                                                    @change.prevent="author_form.Author.resetError(1)"
                                                    :class="author_form.Author.hasError(1)"
                                                    v-model="author_form.Author.second_name">
                                                </div>
                                                
                                            </div>

                                            <div class="form-group">
                                                <input type="email" class="form-control" id="exampleInputEmail"
                                                    placeholder="Enter Author email"
                                                    @change.prevent="author_form.Author.resetError(2)"
                                                    :class="author_form.Author.hasError(2)"
                                                    v-model="author_form.Author.email">
                                            </div>
                                            <div class="form-group row">

                                                <div class="col-md-8 col-lg-8">
                                                    <input type="text" class="form-control" id="exampleInputEmail"
                                                    placeholder="Enter Author institution"
                                                    @change.prevent="author_form.Author.resetError(3)"
                                                    :class="author_form.Author.hasError(3)"
                                                    v-model="author_form.Author.institute">
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <input type="text" class="form-control" id="exampleInputEmail"
                                                    placeholder="Enter Author country"
                                                    @change.prevent="author_form.Author.resetError(4)"
                                                    :class="author_form.Author.hasError(4)"
                                                    v-model="author_form.Author.location">
                                                </div>
                                                
                                            </div>

                                            <div class="form-group">
                                                <select class="form-control" id="exampleInputEmail"
                                                    v-model="author_form.Author.gender"
                                                    @change.prevent="author_form.Author.resetError(5)"
                                                    :class="author_form.Author.hasError(5)">
                                                    <option value="-1">Select author sex</option>
                                                    <option value="0">Male</option>
                                                    <option value="1">Female</option>
                                                </select>

                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-success"
                                                @click.prevent="addNewAuthor()"> Add author</button>
                                            </div>


                                            <hr>

                                        </form>

                                    </div>
                                </div>

                                <div class="card author_information" v-if="submission_tabs.active_tab === 2">
                                    <div class="card-header bg-gradient-primary" style="color:white">
                                        <i class="fas fa-fw fa-info"></i> Upload files
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="box">
                                            <div class="box-head">
                                                File requirements
                                            </div>
                                            <div class="box-content">
                                                <ol>
                                                    <li>Manuscript File size does not exceed more than 100 MB</li>
                                                    <li>Total size of submission files must be within 500 MB</li>
                                                    <li>Select file type in each submission file</li>
                                                    <li>Click save and continue to proceed the next step</li>
                                                </ol>
                                            </div>
                                        </div>
                                        <div class="box">
                                            Click on the file you want to upload
                                            <div class="row">
                                                <button class="btn btn-success col-md-3 col-lg-3" 
                                                @click.prevent="$refs.manuscript_uploader.click()">
                                                    <i class="fas fa-fw fa-file-archive"></i>
                                                    Manuscript
                                                </button>
                                                <button class="btn btn-dark col-md-3 col-lg-3"
                                                @click.prevent="$refs.cover_uploader.click()">
                                                    <i class="fas fa-fw fa-file-pdf"></i>
                                                    Cover
                                                </button>
                                                <button class="btn btn-info col-md-3 col-lg-3"
                                                @click.prevent="$refs.figures_uploader.click()">
                                                    <i class="fas fa-fw fa-camera"></i>
                                                    Figures
                                                </button>
                                                <button class="btn btn-secondary col-md-3 col-lg-3"
                                                @click.prevent="$refs.others_uploader.click()">
                                                    <i class="fas fa-fw fa-table"></i>
                                                    Others
                                                </button>
                                            </div>
                                            <div class="row">
                                                <input type="file" style="visibility:hidden" ref="manuscript_uploader"
                                                @change.prevent="prepareManuscriptFiles($event,0)"
                                                accept="application/msword,
                                                application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                                <input type="file" style="visibility:hidden" ref="cover_uploader" 
                                                @change.prevent="prepareManuscriptFiles($event,1)"
                                                accept="application/msword,
                                                application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                                <input type="file" style="visibility:hidden" ref="figures_uploader" 
                                                @change.prevent="prepareManuscriptFiles($event,2)" 
                                                accept="image/jpeg,image/png,image//jpeg">
                                                <input type="file" style="visibility:hidden" ref="others_uploader"
                                                @change.prevent="prepareManuscriptFiles($event,3)"
                                                accept="image/jpeg,image/png,image//jpeg">
                                            </div>
                                        </div>
                                        <div class="box mt-3">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th scope="col">File name</th>
                                                        <th scope="col">File type</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <tr 
                                                      v-if="Manuscript_data.manuscript_files.manuscript !== null &&
                                                      Manuscript_data.manuscript_files.manuscript.src !== null">
                                                        <td scope="row">@{{Manuscript_data.manuscript_files.manuscript.name}}</td>
                                                        <td>@{{Manuscript_data.manuscript_files.manuscript.type}}</td>
                                                        <td>Ready to upload</td>
                                                        <td>
                                                            <button class="btn btn-danger">-Remove</button>
                                                        </td>
                                                      </tr>
                                                      <tr 
                                                      v-if="Manuscript_data.manuscript_files.cover !== null &&
                                                      Manuscript_data.manuscript_files.cover.src !== null">
                                                        <td scope="row">@{{Manuscript_data.manuscript_files.cover.name}}</td>
                                                        <td>@{{Manuscript_data.manuscript_files.cover.type}}</td>
                                                        <td>Ready to upload</td>
                                                        <td>
                                                            <button class="btn btn-danger">-Remove</button>
                                                        </td>
                                                      </tr>
                                                      <tr 
                                                      v-for="(figure, fkey) in Manuscript_data.manuscript_files.figures "
                                                      :key="fkey">
                                                        <td scope="row">@{{ figure.name}}</td>
                                                        <td>@{{figure.type}}</td>
                                                        <td>Ready to upload</td>
                                                        <td>
                                                            <button class="btn btn-danger">-Remove</button>
                                                        </td>
                                                      </tr>
                                                      <tr 
                                                      v-for="(other, fkey) in Manuscript_data.manuscript_files.others "
                                                      :key="fkey">
                                                        <td scope="row">@{{ other.name}}</td>
                                                        <td>@{{other.type}}</td>
                                                        <td>Ready to upload</td>
                                                        <td>
                                                            <button class="btn btn-danger">-Remove</button>
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card author_information" v-if="submission_tabs.active_tab === 3">
                                    <div class="card-header bg-gradient-primary" style="color:white">
                                        <i class="fas fa-fw fa-info"></i> Review and submit
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="box">
                                            <p>
                                                Your submission is almost ready, once it will be approved, 
                                                a pdf file will be uploaded to your profile. 
                                                You can track the status of your submissions in the pending submission of your profile page.
                                            </p>
                                        </div>
                                        <div class="box">
                                            <div class="box-head">Submission authors</div>
                                            <div class="box-content">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                          <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Institution</th>
                                                            <th scope="col">Location</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(author, akey) in Manuscript_data.manuscript_authors" :key="akey">
                                                                <th scope="row">@{{akey+1}}</th>
                                                                <td>@{{author.first_name + author.second_name}}</td>
                                                                <td>@{{author.email}}</td>
                                                                <td>@{{author.institute}}</td>
                                                                <td>@{{author.location}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box mt-4">
                                            <div class="box-head">
                                                Submission files
                                            </div>
                                            <div class="box-content">
                                                <div class="table-responsive">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                              <tr>
                                                                <th scope="col">File name</th>
                                                                <th scope="col">File type</th>
                                                                <th scope="col">Status</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr 
                                                                v-if="Manuscript_data.manuscript_files.manuscript !== null &&
                                                                Manuscript_data.manuscript_files.manuscript.src !== null">
                                                                  <td scope="row">@{{Manuscript_data.manuscript_files.manuscript.name}}</td>
                                                                  <td>@{{Manuscript_data.manuscript_files.manuscript.type}}</td>
                                                                  <td>Ready to upload</td>
                                                                </tr>
                                                                <tr 
                                                                v-if="Manuscript_data.manuscript_files.cover !== null &&
                                                                Manuscript_data.manuscript_files.cover.src !== null">
                                                                  <td scope="row">@{{Manuscript_data.manuscript_files.cover.name}}</td>
                                                                  <td>@{{Manuscript_data.manuscript_files.cover.type}}</td>
                                                                  <td>Ready to upload</td>
                                                                </tr>
                                                                <tr 
                                                                v-for="(figure, fkey) in Manuscript_data.manuscript_files.figures "
                                                                :key="fkey">
                                                                  <td scope="row">@{{ figure.name}}</td>
                                                                  <td>@{{figure.type}}</td>
                                                                  <td>Ready to upload</td>
                                                                </tr>
                                                                <tr 
                                                                v-for="(other, fkey) in Manuscript_data.manuscript_files.others "
                                                                :key="fkey">
                                                                  <td scope="row">@{{ other.name}}</td>
                                                                  <td>@{{other.type}}</td>
                                                                  <td>Ready to upload</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box mt-4">
                                            <h4>
                                                By Clicking on Submit you agree that you have:-
                                            </h4>
                                            <ol>
                                                <li>
                                                    Followed all respective
                                                    <a href="/documentation/authors">guidelines</a>  
                                                    during submission
                                                </li>
                                                <li>Carefully reviewed your submission.</li>
                                                <li>Approve it for the consideration by this Soscentre journal.</li>
                                            </ol>
                                        </div>
                                        <div class="box-4">
                                            <button class="btn btn-danger">Clear all</button>
                                            <button class="btn btn-primary" @click.prevent="saveScript()">Submit</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer text-center">
                                <button class="btn btn-warning" v-if="submission_tabs.active_tab > 0"
                                @click.prevent="submission_tabs.active_tab--">Previous</button>
                                <button class="btn btn-primary"  v-if="submission_tabs.active_tab < 3"
                                @click.prevent="submission_tabs.active_tab++">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

@endsection


@section('custom_scripts')

<script>
    window.api_token = "{{Auth::user()->api_token}}"
    
</script>
@php 
$hash = hash('md5', file_get_contents(public_path('js/new_submission.js')));
@endphp
<script src="/js/new_submission.js?{{$hash}}"></script>

@endsection