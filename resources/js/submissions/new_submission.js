require ("../bootstrap")

import Manuscript from "./Manuscript";
import Author from "./Author";
import Error from "../classes/Error";

// compnents
import errormodal from "../modals/errormodal.vue";
var app = new Vue({
    el: "#wrapper",
    data: {
        error_fields: [],
        error_text:[],
        Server: new Server(),
        token: null,
        submission_tabs: {
            active_tab : 0
        },
        Manuscript_data : new Manuscript(),
        author_form: {
            visible:false,
            text: ' + New Author ',
            Author: new Author(),
        },
        Profile:null,
        figure_holder:null,
        Error: new Error(),
        
    },
    mounted() {
        // alert('ready');
        this.setApiToken();
        this.getPersonInformation();
    },
    methods: {

        saveScript()
        {
            this.Server.setRequest();
            // req.authors = this.Manuscript_data.getScriptAuthors();
            var req = this.Manuscript_data.getScriptForm()

            req.append('api_token' , this.token)
            this.Server.setRequest(req);
            this.Server.serverRequest('/api/submission/manuscript', this.AuthorSaved, this.showError);
            // this.Server.serverRequest('/api/submission/authors', this.AuthorSaved, this.showError);
        },

        AuthorSaved(data)
        {
            console.log('saved author ',data);
        },

        prepareManuscriptFiles(event, type)
        {
            var input = event.target;
            console.log('input ',input);

            
            if(parseInt(type) === 0)
            {
                console.log('type of ',type)
                var ext = input.files[0].type;
                if(this.Manuscript_data.isNotvalidFile(ext,0))
                {
                    this.showError("Only .doc and docx documents are allowed for the mansucript")
                    return;
                }
                this.Manuscript_data.manuscript_files.manuscript = {
                    src: null,
                    name: input.files[0].name,
                    type: 'Manuscript',
                }
                this.Server.previewFile(input,this.prepareManuscript, this.showError);
            }
            else if(parseInt(type) === 1)
            {
                console.log('type of ',type)
                var ext = input.files[0].type;
                if(this.Manuscript_data.isNotvalidFile(ext,1))
                {
                    this.showError("Only .doc and docx documents are allowed for the cover file")
                    return;
                }
                this.Manuscript_data.manuscript_files.cover = {
                    src: null,
                    name: input.files[0].name,
                    type: 'Cover',
                }
                this.Server.previewFile(input,this.prepareCover, this.showError);
            }
            else if(parseInt(type) === 2)
            {
                console.log('type of ',type)
                var ext = input.files[0].type;
                if(this.Manuscript_data.isNotvalidFile(ext,2))
                {
                    this.showError("Only  jpeg, jpg and png figures are allowed")
                    return;
                }
                this.figure_holder = {
                    src: null,
                    name: input.files[0].name,
                    type: 'Figure',
                }
                this.Server.previewFile(input, this.prepareFigures, this.showError);
            }
            else if(parseInt(type) === 3)
            {
                console.log('type of ',type)
                console.log('type of ',type)
                var ext = input.files[0].type;
                if(this.Manuscript_data.isNotvalidFile(ext,3))
                {
                    this.showError("Only  jpeg, jpg and png figures are allowed")
                    return;
                }
                this.figure_holder = {
                    src: null,
                    name: input.files[0].name,
                    type: 'Figure',
                }
                this.Server.previewFile(input, this.prepareOthers, this.showError);
            }
                
        },
        prepareManuscript(file)
        {
            
            console.log('file  ',file);
            this.Manuscript_data.manuscript_files.manuscript.src =file.target;
        },
        prepareCover(file)
        {
            console.log('file  ',file);
            this.Manuscript_data.manuscript_files.cover.src =file.target;
        },
        prepareFigures(file)
        {
            console.log('file  ',file);
            this.figure_holder.src =file.target.result;
            this.Manuscript_data.manuscript_files.figures.push(this.figure_holder);
            this.figure_holder = null;
        },
        prepareOthers(file)
        {

            console.log('file  ',file);
            this.figure_holder.src =file.target.result;
            this.Manuscript_data.manuscript_files.others.push(this.figure_holder);
            this.figure_holder = null;
        },
        getPersonInformation()
        {
            this.Server.setRequest({
                api_token : this.token,
            });
            this.Server.serverRequest("/api/profile/details", this.setProfileDetails, this.showError);
        },
        setProfileDetails(data)
        {
            if(data[0])
                data[0];
            this.Profile = data.Profile;
        },
        toggleAuthorForm()
        {
            this.author_form.visible = !this.author_form.visible;
            if(this.author_form.visible)
            {
                this.author_form.text = " - Cancel ";

            }    
            else
            {
                this.author_form.Author = new Author();
                this.author_form.text = " + New Author"

            }
                
        },
        addNewAuthor()
        {
            if(this.author_form.Author.hasFilledAll())
            {
                this.Manuscript_data.manuscript_authors.push(this.author_form.Author.getAuthorDetails());
                this.toggleAuthorForm();
            }
            
        },
        deleteAuthor(author)
        {
            var current_authors = this.Manuscript_data.manuscript_authors;
            var new_authors =[];
            this.Manuscript_data.manuscript_authors.forEach(function(author_data){
                if(author.email === author_data.email)
                    console.log('delete author ',author.email);
                else
                    new_authors.push(author_data);
            })
            this.Manuscript_data.manuscript_authors = new_authors;

        },
        setAsOnlyAuthor()
        {
            this.Manuscript_data.manuscript_authors = [];
            this.Manuscript_data.manuscript_authors.push(this.Profile);
            
        },
        getAuthorClass()
        {
            if(this.author_form.visible)
                return 'btn-danger';
            else 
                return 'btn-success'
        },
        setActiveSubmissionTab(tab_index)
        {
            if(tab_index > 3 || tab_index < 0)
                return;
            this.submission_tabs.active_tab = tab_index;
        },
        setApiToken()
        {
            this.token = window.api_token;
        },
        showError(error)
        {
            console.log('Error --> ',error);
            this.Error.error_text = error;
            this.Error.visible = true;
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

    },
    components: {errormodal}
})