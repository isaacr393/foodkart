<template>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height:100%; ">
        
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 70%; height: 300px; background-color: #1e1f1e; ">
            
            <div class="header" style="margin-bottom: 40px; " > 
                <h2 style="color: white;">Seleccione idioma</h2>
            </div>
            <div style="display: flex; justify-content: space-around; width: 100%;">
                <div class="spanish">
                    <a @click="setLanguage('es')" style="color: white; cursor: pointer;">
                        <img src="img" alt="ESPANOL" >
                    </a>                
                </div>
                <div class="english">
                    <a @click="setLanguage('en')" style="color: white; cursor: pointer;">
                        <img src="img" alt="ENGLISH" >
                    </a>                
                </div>
            </div>

        </div>

    </div>
</template>

<script>
export default {

    methods:{
        setLanguage( lan ){
            this.$emit( 'setLang', lan )
        }
    }
}
</script>

<style>

</style>