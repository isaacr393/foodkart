<template>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height:100%; ">
        <header style="display: flex; justify-content: space-between; width: 100%;">
            <h2 style="display: flex; justify-content: end; width: 52%;">Registro</h2>  
            <div  >{{ currentStep + " / 8" }} <span style="margin-left: 10px; cursor: pointer;" @click="reloadForm"> RELOAD </span> </div>
        </header>


        <Language  v-if="currentStep == 1" @setLang="setLang" />

        <Terminos v-if="currentStep == 2" @setLang="setLang" @prev="currentStep--" @next="currentStep++"/>
    </div>
</template>

<script>
import Language from './language.vue';
import Terminos from './terminos.vue';
export default {
    data(){
        return {
            currentStep: 2,
            form:{},
        }
    },

    components:{ Language, Terminos },

    methods:{
        setLang(lang){
            console.log('here',lang)
            this.currentStep = 2
        },

        reloadForm(){

        }
    }
}
</script>

<style>

</style>