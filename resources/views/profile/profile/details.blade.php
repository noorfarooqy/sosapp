@extends('profile.layout.main')
@section('custom-links')
<link href="/css/custom/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    

      <div class="row">
          <div class="col-md-1 col-lg-1"></div>
          <div class="col-md-10 col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="title">Edit profile details</h4>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-5">
                            <div class="card">
                                @if (isset($profile_data))
                                <div class="card-header alert alert-info">Your current details</div>
                                @else
                                <div class="card-header alert alert-danger">Please complete your profile</div>
                                @endif
                                
                            </div>
                            <div class="card-body">
                                <div class="border-bottom-info text-center mb-3">
                                    @if (isset($profile_data))
                                        <span style="color:black"></span>
                                        <img src="{{$profile_data->profile_picture}}" alt="" height="150" 
                                        style="border:medium solid gray; padding:10px; margin-bottom:10px; cursor:pointer">
                                        
                                    @else
                                    <img src="/assets/images/photo-camera.svg" alt="" height="150"
                                    style="border:medium solid gray; padding:10px; margin-bottom:10px; cursor:pointer">
                                    
                                    @endif
                                    
                                </div>
                                <div class="border-left-info ">
                                    <i class="fas fa-fw fa-user"></i> <span >Your Current Title:</span>
                                    <br>
                                    <i class="fas fa-fw"></i>
                                    @if (isset($profile_data))
                                    <span style="color:black" v-if="user_title_text !== null">@{{user_title_text}}</span>
                                    <span style="color:black" v-else>{{$profile_data->user_title}}</span> 
                                    <span style="color:black">{{Auth::user()->name}}</span> 
                                    
                                        
                                    @else

                                    <span style="color:black" v-if="user_title_text !== null">@{{user_title_text}}
                                        {{Auth::user()->name}}</span>
                                    <span style="color:black" v-else>{{Auth::user()->name}}</span>
                                   
                                    @endif

                                    
                                </div>
                                <div class="border-left-info mt-4">
                                    <i class="fas fa-fw fa-wrench"></i> <span >Your Current Profession:</span>
                                    <br>
                                    <i class="fas fa-fw"></i>
                                    @if (isset($profile_data))
                                        <span style="color:black" v-if="profession !== null">@{{profession}}</span>
                                        <span style="color:black" v-else>{{$profile_data->profession}}</span>
                                        
                                    @else
                                    <span style="color:black" v-if="profession !== null">@{{profession}}</span>
                                    <span style="color:black" v-else>Unknown</span>
                                    
                                    @endif
                                </div>


                                <div class="border-left-info mt-4">
                                    <i class="fas fa-fw fa-map"></i> <span >Your Current Address:</span>
                                    <br>
                                    <i class="fas fa-fw"></i>
                                    @if (isset($profile_data))

                                        <span style="color:black" v-if="living_country_text !== null">@{{living_country_text}}</span>
                                        <span style="color:black" v-if="living_city !== null">@{{living_city}}</span>
                                        <span style="color:black" v-else>
                                            {{$profile_data->living_city}}, 
                                            {{$profile_data->living_country}}
                                        </span>
                                        
                                    @else
                                    <span style="color:black" v-if="living_country_text !== null">@{{living_country_text}},</span>
                                    <span style="color:black" v-if="living_city !== null">@{{living_city}}</span>
                                    <span style="color:black" v-else>Unknown</span>
                                    
                                    @endif
                                </div>



                                <div class="border-left-info mt-4">
                                    <i class="fas fa-fw fa-building"></i> <span >Your Current institute:</span>
                                    <br>
                                    <i class="fas fa-fw"></i>
                                    @if (isset($profile_data))
                                    <span style="color:black" v-if="inst_name !== null">@{{inst_name}},</span>
                                        <span style="color:black" v-else>
                                            {{$profile_data->institute}} in 
                                            {{$profile_data->institute_country}}
                                        </span>
                                        
                                    @else
                                    <span style="color:black" v-if="inst_name !== null">@{{inst_name}} in </span>
                                    <span style="color:black" v-if="inst_location !== null">@{{inst_location}},</span>
                                    <span style="color:black" v-else>Unknown country</span>
                                    
                                    @endif
                                </div>

                                <div class="border-left-info mt-4">
                                    <i class="fas fa-fw fa-man"></i> <span >Your gender:</span>
                                    <br>
                                    <i class="fas fa-fw"></i>
                                    @if (isset($profile_data))
                                    <span style="color:black" v-if="gender_text !== null">
                                        @{{gender_text}}  </span>
                                        <span style="color:black" v-else>
                                            {{$profile_data->gender === 0 ? "Male" : "Female"}}
                                        </span>
                                        
                                    @else

                                    <span style="color:black" v-if="gender_text !== null">@{{gender_text}} </span>
                                    <span style="color:black" v-else>Unknown</span>
                                    
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 card">
                            <div class="p-5">
                              <div class=" card-header">
                                <h1 class="h4 text-gray-900 mb-2">Update account information </h1>
                                <p class="mb-4">
                                    You will be able to submit papers and get access to other functions in completing the setup.
                                </p>
                              </div>
                              <form class="user card-body">
                                  @csrf
                                <div class="form-group">
                                    <label for="title" class="label">What is your title?</label>
                                  <select name="user_title" id="user_title" v-model="user_title" class="select form-control form-control-user"
                                  style="height:auto" @change.prevent="updateTitleText($event)"
                                  :class="getErrorDetails(0)" >
                                        <option value="-1" selected>Select title</option>
                                        <option value="0">Mr</option>
                                        <option value="1">Mrs</option>
                                        <option value="2">Prof</option>
                                        <option value="3">Sir</option>
                                        <option value="4">Dr</option>
                                        <option value="5">Eng</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                <label for="title" class="label">What is your profession ?</label>
                                  <input type="text" class="form-control form-control-user" name="profession" v-model="profession"
                                  aria-describedby="emailHelp" placeholder="Enter city name..."
                                  :class="getErrorDetails(1)" @change.prevent="resetError(1)">
                                </div>
                                <div class="form-group">
                                    <label for="title" class="label">Which country do you live?</label>
                                    @php $country_model = 'living_country_index' @endphp
                                    @include('profile.layout.country_list')
                                </div>
                                <div class="form-group">
                                <label for="title" class="label">Which city do you live in @{{living_country_text}}?</label>
                                  <input type="text" class="form-control form-control-user" name="living_city" v-model="living_city"
                                  aria-describedby="emailHelp" placeholder="Enter city name..."
                                  :class="getErrorDetails(3)" @change.prevent="resetError(3)">
                                </div>
                                <div class="form-group">
                                    <label for="title" class="label">Which institute do you attend?</label>
                                  <input type="text" class="form-control form-control-user" name="inst_name" v-model="inst_name"
                                   aria-describedby="emailHelp" placeholder="Enter Institute name..."
                                   :class="getErrorDetails(4)" @change.prevent="resetError(4)">
                                </div>
                                <div class="form-group">
                                <label for="title" class="label">where is  
                                    <span v-if="inst_name !== null && inst_name !== '' ">
                                        @{{inst_name !== null ? inst_name : 'Institute'}} located at
                                    </span>
                                    <span v-else> the institute located at</span>
                                    ?</label>
                                  <input type="text" class="form-control form-control-user " name="inst_name" v-model="inst_location"
                                   aria-describedby="emailHelp" placeholder="Enter Institute location..." 
                                   :class="getErrorDetails(5)" @change.prevent="resetError(5)">
                                </div>
                                <div class="form-group">
                                    <label for="title" class="label">What is your gender?</label>
                                    <select v-model="gender_index" class="select form-control form-control-user" 
                                    style="height: auto" @change.prevent="updateGenderText($event)"
                                    :class="getErrorDetails(6)">
                                        <option value="0">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                </div>
                                <a href="login.html" class="btn btn-primary btn-user btn-block" @click.prevent="updateUserInfo()">
                                    Update account
                                </a>
                              </form>
                              <hr>
                              <div class="text-center">
                                {{-- <a class="small" href="register.html">Create an Account!</a> --}}
                              </div>
                              <div class="text-center">
                                {{-- <a class="small" href="login.html">Already have an account? Login!</a> --}}
                              </div>
                            </div>
                        </div>
    
                        

                    </div>
                    


                </div>
            </div>
          </div>
          <div class="col-md-1 col-lg-1"></div>
          
      </div>
  
@endsection

@section('custom_scripts')
<script src="/js/custom/select2.js"></script>
@php 
$hash = hash('md5', file_get_contents(public_path('js/profile.js')));
@endphp
<script src="/js/profile.js?{{$hash}}"></script>
<script>
    window.api_token = "{{Auth::user()->api_token}}"
    $(document).ready(function() {
        
    });
</script>
@endsection