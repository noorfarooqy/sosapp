require ("../bootstrap")


var app = new Vue({
    el: "#wrapper",
    data: {
        user_title:null,
        user_title_text:null,
        living_country_text:null,
        living_country_index:0,
        living_city:null,
        inst_name:null,
        gender_text:null,
        gender_index:null,
        profession:null,
        inst_location:null,
        error_fields: [],
        error_text:[],
        Server: new Server(),
        token: null,
    },
    mounted() {
        // alert('ready');
    },
    methods: {

        updateUserInfo()
        {
            if(!this.hasFilledAllData())
            {
                console.log('Please fill the remaining ffields')
                return;
            }
            var req = this.getRequest();
            this.Server.setRequest(req);
            this.Server.serverRequest('/api/profile/update', this.successUpdate, this.showError);
        },
        successUpdate(data)
        {
            console.log('succes update ',data)
        },

        getRequest()
        {
            return {
                user_title: this.user_title_text,
                user_profession: this.profession,
                user_country: this.living_country_text,
                user_city: this.living_city,
                user_institute: this.inst_name,
                user_institute_location: this.inst_location,
                user_gender: this.gender_index,
                _token: document.querySelector('input[name="_token"]').value,
                api_token: window.api_token
            }
        },

        hasFilledAllData()
        {
            this.error_fields = [];
            if(this.user_title === null || this.user_title === "")
            {
                this.error_fields.push(0);
            }
            if(this.profession === null || this.profession.length < 3)
            {
                this.error_fields.push(1);
            }
            if(this.living_country_text === null || this.living_country_text === "")
            {
                this.error_fields.push(2);
            }
            if(this.living_city === null || this.living_city === "")
            {
                this.error_fields.push(3);
            }
            if(this.inst_name === null || this.inst_name === "")
            {
                this.error_fields.push(4);
            }
            if(this.inst_location === null || this.inst_location === "")
            {
                this.error_fields.push(5);
            }
            if(this.gender_text !== "Male" && this.gender_text !== "Female")
            {
                this.error_fields.push(6);
            }

            if(this.error_fields.length > 0)
                return false;
            else
                return true


        },
        showError(error)
        {
            console.log('Error --> ',error);
        },
        getErrorDetails(key)
        {
            if(-1 < this.error_fields.indexOf(parseInt(key)))
            {
                return 'alert alert-danger';
            }
        },
        resetError(key)
        {
            var index = this.error_fields.indexOf(parseInt(key));
            if(index >= 0)
            {
                this.error_fields.splice(index, 1);
            }
        },

        updateCountryName(event)
        {
            var index = event.target.options.selectedIndex;
            this.living_country_text = event.target.options[index].text;
            this.resetError(2)
        },
        updateTitleText(event)
        {
            var index = event.target.options.selectedIndex;
            this.user_title_text = event.target.options[index].text;
            this.resetError(0)
        },
        updateGenderText(event)
        {
            var index = event.target.options.selectedIndex;
            this.gender_text = event.target.options[index].text;
            this.resetError(6)
        }

    }
})