<div class="card">
    <div class="card-header">
        <p class="card-header-title">Isdiiwan gali</p>
        <span class="card-header-icon">
            <i class="fas fa-user"></i>
        </span>
    </div>
    <div class="card-content">
        <div class="field has-text-centered is-flex">
            <div class="circle register_stage stage_1" :class="activeStage(0)">1</div>
            <div class="circle register_stage stage_2" :class="activeStage(1)">2</div>
            <div class="circle register_stage stage_2" :class="activeStage(2)">3</div>
            <div class="circle register_stage stage_2" :class="activeStage(3)">4</div>
        </div>
        <div class="column" v-if="register.stage_one">
            <div class="field">
                <label class="label">Magacaaga 1aad</label>
                <div class="control">
                    <input class="input" type="email" placeholder="e.g Magaacaga 1aad"
                        v-model="Person.first_name">
                </div>
            </div>
            <div class="field">
                <label class="label">Magacaaga 2aad</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Magacaaga 2aad"
                    v-model="Person.last_name">
                </div>
            </div>
            <div class="field">
                <label class="label">Email kaaga</label>
                <div class="control">
                    <input class="input" type="text" placeholder="tusaale, magaca@gmail.org"
                    v-model="Person.email">
                </div>
            </div>
        </div>

        <div class="column" v-if="register.stage_two">
            <div class="field">
                <label class="label">Magaalada aad kunooshahay?</label>
                <div class="control">
                    <input class="input" type="text" placeholder="tusaale, Baydhabo"
                    v-model="Person.living_city">
                </div>
            </div>
            <div class="field">
                <label class="label">Wadankee kunooshahay?</label>
                <div class="control">
                    <input class="input" type="text" placeholder="tusaale, Soomaaliya"
                    v-model="Person.living_country">
                </div>
            </div>
            <div class="field">
                <label class="label">Jinsiyadaada?</label>
                <div class="control">
                    <div class="select" >
                        <select v-model="Person.gender">
                            <option value="0">Rag</option>
                            <option value="1">Dumar</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>


        
        <div class="column" v-if="register.stage_three">
            <div class="field">
                <label class="label">Xirfadaada?</label>
                <div class="control">
                    <input class="input" type="text" placeholder="tusaale, Arday, Dakhtar, Macalin"
                    v-model="Person.profession">
                </div>
            </div>
            <div class="field">
                <label class="label">Magaca hay'ada ama iskuulka aad joogto?</label>
                <div class="control">
                    <input class="input" type="text" placeholder="tusaale, Arday, Dakhtar, Macalin"
                    v-model="Person.institution">
                </div>
            </div>
            <div class="field">
                <label class="label">Wadanka ay kutaalo hay'ada ama iskuulka?</label>
                <div class="control">
                    <input class="input" type="text" placeholder="tusaale, Arday, Dakhtar, Macalin"
                    v-model="Person.institution_location">
                </div>
            </div>

        </div>
        <div class="column" v-if="register.stage_four">
            <div class="field">
                <label class="label">Passwordka sirta </label>
                <div class="control">
                    <input class="input" type="password" placeholder="Password ama sirta"
                    v-model="Person.password">
                </div>
            </div>
            <div class="field">
                <label class="label">Xaqiiji passwordka sirta </label>
                <div class="control">
                    <input class="input" type="password" placeholder="Xaqiiji passwordkaaga"
                    v-model="Person.confirm_password">
                </div>
            </div>
            <div class="field ">
                <label class="label"></label>
                <div class="control buttons">
                    <button  class="button is-success" @click.prevent="completeRegistration()" >Dhameestir Isdiiwan galinta</button>
                </div>
            </div>
        </div>
        <div class="column is-flex has-text-centered">
            <div class="button" :disabled="register.active_stage == 0" @click="openNextStage(false)"> << Previous</div>
            <div class="button " :disabled=" register.active_stage == 3 " @click="openNextStage()"> Next >> </div>
        </div>


    </div>
</div>
