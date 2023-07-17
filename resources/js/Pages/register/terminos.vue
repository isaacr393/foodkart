<template>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height:100%; color: white; ">
        
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 70%; height: 100px; background-color: #1e1f1e; border-top-left-radius: 20px; border-top-right-radius: 20px;">
            <h2> TERMINOS </h2>
            <p>Lea los terminos, aceptelos y presione siguiente</p>
        </div>

        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 70%; height: 300px; background-color: #1e1f1e;">
            <h2 style="text-align: center;"> TERMINOS  Y CONDICIONES, AL ADQUIRIR UN TICKET EL PILOTO ACEPTA Y SE COMPROMETE A CUMPLIR ESTRICTAMENTE LAS SIGUIENTES NORMAS DE CUMPLIMIENTO </h2>
            <p>Lea los terminos, aceptelos y presione siguiente</p>
        </div>

        <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 70%; height: 50px; background-color: #1e1f1e;">
            <p style="margin-left: 15px;">Aceptar terminos y condiciones</p>
            <div style="margin-right: 20px;">
                <Toggle
                    v-model="aceptado"
                ></Toggle>
            </div>            
        </div>

        <div style="width: 95%; border: 1px solid white;"></div>

        <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 70%; height: 40px; background-color: #4d4b4b; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
            <div style="display: flex; justify-content: center; width:50% ; border-right: 3px solid white; height: 40px; ">
                <button class="btn btn-inverse" @click="prev" style="width: 100%;">
                    PREVIO
                </button>
            </div>
            <div style="display: flex; justify-content: center; width:50% ;" >
                <button class="btn btn-inverse" @click="next" style="width: 100%;" :disabled="aceptado == false" >
                    SIGUIENTE
                </button>
            </div>
        </div>

    </div>
</template>

<script>
import Toggle from '@vueform/toggle'
export default {

    components: { Toggle, },

    data(){
        return{
            aceptado: false,
        }
    },

    methods:{
        prev(){
            this.$emit('prev')  
        },

        next(){
            this.$emit('next')  
        },
    },
}
</script>
<style src="@vueform/toggle/themes/default.css"></style>