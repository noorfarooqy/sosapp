<template>
  <div class="card">
    <div class="card-header bg-primary text-white">
      <i class="fa fa-pencil-alt fa-1x mr-3"></i>
      <!-- {{$publication->submission_title}} -->
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-3 col-lg-3">
          <img
            :src="''"
            height="200"
            width="100%"
            class="ml-2 mt-2 border"
            alt=""
          />
        </div>
        <div class="col-md-1 col-lg-1"></div>
        <div class="col-md-7 col-lg-7">
          <h3 class="mb-2" style="text-decoration: underline">
            <i class="fa fa-pencil-alt mr-3"></i>
            <!-- {{$publication->submission_title}} -->
          </h3>
          <p class="text-justify">
            <!-- {!! str_replace("\n", '<br>' , $publication->submission_abstract) !!} -->
          </p>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header bg-primary text-white">
              Manuscript files
            </div>
            <div class="card-body">
              <i class="fa fa-2x fa-file-pdf"></i>
              <span class="fa fa-2x ml-3">
                <a :href="''" target="_blank"> View PDF </a>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header bg-primary text-white">
              Authors @php $authors = $publication->subAuthors; @endphp
            </div>
            <div class="card-body">
              <table class="table text-dark">
                <thead class="thead">
                  <tr>
                    <th>Author name</th>
                    <th>Institute</th>
                    <th>Location</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- @foreach ($authors as $author) -->
                  <tr>
                    <td>
                      <!-- {{$author->author_firstname. " "}} -->
                      <!-- {{$author->author_secondname}} -->
                    </td>
                    <td>
                      <!-- {{$author->author_institute}} -->
                    </td>
                    <td>
                      <!-- {{$author->author_location}} -->
                    </td>
                  </tr>
                  <!-- @endforeach -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {},
  methods: {},
  mounted() {
    alert("ready");
  },
};
</script>