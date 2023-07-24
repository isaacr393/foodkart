<template>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height:100%; ">        
        
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 70%; 
                    background-color: #1e1f1e; color: white; border-radius: 20px; min-height: 400px%; ">            
            
            <div style="background-color: #1e1f1e; width: 100%; height: 100px; padding: 20px; display: flex; flex-direction: column; justify-content: center; align-items: center; border-radius: 20px;">
                <h5>Firma</h5>
                <p>Por favor firme abajo para confirmar su registro y pulse siguiente</p>
            </div>

            <div id="photoReproducer" style="width: 100%; display: flex; justify-content: center; align-items: center; flex-direction: column;">                

            </div>


            <div style="width: 100%; border: 1px solid white; margin-top: 20px;"></div>

            <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%; height: 40px; background-color: #4d4b4b; border-radius: 20px; ">
                <div style="display: flex; justify-content: center; width:50% ; border-right: 3px solid white;">
                    <button class="btn btn-inverse" @click="prev" style="width: 100%;  color: white">
                        PREVIO
                    </button>
                </div>
                <div style="display: flex; justify-content: center; width:50% ;" >
                    <button class="btn btn-inverse" @click="next" style="width: 100%; color: white;" :disabled="imageBase64 == false" >
                        SIGUIENTE
                    </button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers, numeric, minLength } from '@vuelidate/validators'
export default {
    components:{VueDatePicker,},

    data(){
        return{
            imageBase64: null,
            camera_button: null,
            video: null,
            click_button: null,
            canvas: null,
            cancelButtton: null,
            uploadFile: null,
        }
    },

    mounted(){
        let _this = this        
    },

    methods:{
        next(  ){

            if( this.imageBase64 != null )
                this.$emit('imgSet', { image: this.imageBase64 })
        },

        prev(){
            this.imageBase64 = null
            this.$emit('prev')
        },        

        uploadFoto(){
            document.querySelector("#upload-photo").click()
        },        
    }
}
</script>

<style>
    #upload-photo {
        opacity: 0;
        position: absolute;
        z-index: -1;
    }
</style>F