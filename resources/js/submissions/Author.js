export default class {
    constructor()
    {
        this.first_name = null;
        this.second_name = null;
        this.email = null;
        this.institute = null;
        this.location = null;
        this.gender = null;
        this.fill_erros =[];
    }
    getAuthorDetails()
    {
        return {
            first_name: this.first_name,
            second_name: this.second_name,
            email: this.email,
            institute: this.institute,
            location: this.location,
            gender : this.gender
        }
    }
    hasFilledAll()
    {
        this.fill_erros = [];
        if(this.first_name === null || this.first_name.length <= 2  )
        {
            this.fill_erros.push(0);
            return false;
        }
        else if(this.second_name === null || this.second_name.length <= 2  )
        {
            this.fill_erros.push(1);
            return false;
        }
        else if(this.email === null || this.email.length <= 5  )
        {
            this.fill_erros.push(2);
            return false;
        }
        else if(this.institute === null || this.institute.length <= 4  )
        {
            this.fill_erros.push(3);
            return false;
        }
        else if(this.location === null || this.location.length <= 4  )
        {
            this.fill_erros.push(4);
            return false;
        }
        else if(parseInt(this.gender) !== 0 && parseInt(this.gender) !== 1  )
        {
            this.fill_erros.push(5);
            return false;
        }
        return true;
    }
    resetError(key)
    {
        var index = this.fill_erros.indexOf(parseInt(key));
        if(index >= 0)
        {
            this.fill_erros.splice(index, 1);
        }
    }
    hasError(key)
    {

        if(-1 < this.fill_erros.indexOf(parseInt(key)))
        {
            return 'alert alert-danger';
        }
    }
    
}