<form wire:submit.prevent="sendFeedback">
    <div class="inputArea">
        @include('includes.livewire_sessions')
        <div class="form-row">
            <div class="col-md-6">
                <div class="input-group">

                    <input type="text" class="form-control" placeholder="First Name" aria-describedby="Site" required
                    wire:model="first_name">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Site">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">

                    <input type="text" class="form-control" placeholder="Last name" aria-describedby="url" required
                    wire:model="last_name">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="url">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Email" aria-describedby="Contact" required
                    wire:model="email">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Contact">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Subject" aria-describedby="Supportemail"
                        required wire:model="subject">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Supportemail">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12">
                <div class="input-group textAreaWrapper">
                    <div class="relativeArea">
                        <textarea placeholder="Descriptions" aria-describedby="Message" required
                        wire:model="message"></textarea>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Message">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col text-center">
                <button class="submit2" type="submit">Submit</button>
            </div>
        </div>
    </div>
</form>
