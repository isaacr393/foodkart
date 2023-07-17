<template>
    <div style="width: 100%; height:100vh; ">
        <header style="display: flex; justify-content: space-between; width: 100%; background-color: #4d4b4b; color:white">
            <h5 style="display: flex; justify-content: end; align-items: center; width: 52%;">Registro</h5>  
            <div style="display: flex; justify-content: end; align-items: center; " >
                {{ currentStep + " / 8" }} <span style="margin-left: 10px; cursor: pointer;" @click="reloadForm"> RELOAD </span> 
            </div>
        </header>

        <div style="display: flex; justify-content: center; align-items: center; width: 100%; height: 80%;">
            <Language  v-if="currentStep == 1" @setLang="setLang" />
            <Terminos v-if="currentStep == 2" @setLang="setLang" @prev="currentStep--" @next="currentStep++"/>
            <EmailBirthday v-if="currentStep == 3"  @prev="reloadForm" @formSet="formSet"/>
        </div>

    </div>
</template>

<script>
import EmailBirthday from './EmailBirthday.vue';
import Language from './language.vue';
import Terminos from './terminos.vue';
export default {
    data(){
        return {
            currentStep: 3,
            form:{},
        }
    },

    components:{ Language, Terminos, EmailBirthday },

    methods:{
        setLang(lang){
            this.currentStep = 2
        },

        formSet(form){
            this.form = { ...form }
            this.currentStep++
        },

        reloadForm(){
            this.form = {}
            this.currentStep--
        }
    }
}
</script>

<style>

</style>