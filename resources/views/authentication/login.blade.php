<div class="card">
    <div class="card-header">
        <p class="card-header-title">Hore ugal</p>
        <span class="card-header-icon">
            <i class="fas fa-user"></i>
        </span>
    </div>
    <div class="card-content" v-if="login_section.login">
        <div class="field">
            <label class="label">Email address</label>
            <div class="control">
                <input class="input" type="email" placeholder="e.g someone@example.com">
            </div>
        </div>
        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="password" placeholder="Password">
            </div>
        </div>
        <div class="field ">
            <label class="label"></label>
            <div class="control buttons">
                <button  class="button is-success" >Hore ugal</button>
            </div>
        </div>
        <div class="field ">
            <label class="label"></label>
            <div class="control buttons">
                <a class="" href="#" @click.prevent="passwordResetButton()">Waan ilaaway sirta/password</a>
            </div>
        </div>
    </div>
    <div class="card-content" v-if="login_section.forgotpassword">
        <div class="field">
            <label class="label">Email address</label>
            <div class="control">
                <input class="input" type="email" placeholder="e.g someone@example.com">
            </div>
        </div>
        <div class="field ">
            <label class="label"></label>
            <div class="control buttons">
                <button  class="button is-success" >Dib u codso sirta</button>
            </div>
        </div>
        <div class="field ">
            <label class="label"></label>
            <div class="control buttons">
                <a class="" href="#" @click.prevent="showLoginForm()">Hore ugal cinwaankaaga</a>
            </div>
        </div>

    </div>
</div>
