export default class {
    constructor()
    {
        this.manuscript_type = -1;
        this.manuscript_title = null;
        this.manuscript_abstract = null;
        this.mansucript_keywords = null;
        this.manuscript_authors = [];
        this.manuscript_files = {
            manuscript: null,
            cover:null,
            figures: [],
            others: [],
        };
        this.valid_doc = [
            "application/msword",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.template"
        ];
        this.valid_figures = [
            "image/jpeg", "image/jpg", "image/png"
        ]
    }

    hasManInfo()
    {
        if(this.manuscript_type === null || this.manuscript_type == -1)
            return false;
        else if(this.manuscript_title === null || this.manuscript_title.length <= 0)
            return false;
        else if(this.manuscript_abstract === null || this.manuscript_abstract.length <= 0)
            return false;
        else if(this.mansucript_keywords === null || this.mansucript_keywords.length <= 0)
            return false;
        return true;
    }

    hasAuthor()
    {
        if(this.manuscript_authors.length <= 0)
            return false;
        else
            return true;
    }

    hasManuscriptFiles()
    {
        if(this.manuscript_files.manuscript === null)
            return false;
        else if(this.manuscript_files.cover === null)
            return false;
        else if(this.manuscript_files.figures.length <= 0)
                return false;
        else
            return true;
    }
    hasFilledAll()
    {
        if(this.hasAuthor() && this.hasManInfo() && this.hasManuscriptFiles())
            return true;
        return false;
    }
    isNotvalidFile(ext, type)
    {
        console.log('checking extentsion ',ext, ' in type ',type)
        if(type === 0 || type === 1)
        {
            return -1 >=  this.valid_doc.indexOf(ext)
        }
        else if(type === 2 || type === 3)
        {
            return -1 >= this.valid_figures.indexOf(ext)
        }
        return true;
    }

    getScriptForm()
    {
        var formData = new FormData();
        formData.append('mansucript_type', this.manuscript_type);
        formData.append('manuscript_title', this.manuscript_title);
        formData.append('manuscript_abstract', this.manuscript_abstract);
        formData.append('mansucript_keywords', this.mansucript_keywords);
        var a_count =0;
        this.manuscript_authors.forEach(author => {
            
            formData.append('manuscript_authors['+a_count+']', JSON.stringify(author));
            a_count = a_count +1;
        })
        
        formData.append('mansucript_file', this.manuscript_files.manuscript.src);
        formData.append('mansucript_cover', this.manuscript_files.cover.src);
        var fig_count = 0;
        this.manuscript_files.figures.forEach(figure => {
            formData.append('mansucript_figures['+fig_count+']', figure.src);
            fig_count++;
        })
        
        return formData;
    }
    getScriptAuthors()
    {
        return this.manuscript_authors;
    }
}