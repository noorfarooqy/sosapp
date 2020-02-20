var self;
export default class {
    constructor() {
        this.success_title = 'Success';
        this.success_text = null;
        this.visible = false;
        self = this;
    }

    showSuccessModal(success_text='null', success_title='Success!')
    {
        this.success_text = success_text;
        this.success_title = success_title;
        this.visible = true;
    }
    resetSuccessModal()
    {
        self.success_title = "Success";
        self.success_text = 'Success';
        self.visible = false;
    }
}