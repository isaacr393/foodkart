<template>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height:100%; ">        
        
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 70%; 
                    background-color: #1e1f1e; color: white; border-radius: 20px; overflow: hidden; ">            
            
            <div style="background-color: #1e1f1e; width: 100%; height: 100px; padding: 20px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <h5>Email y fecha de nacimiento</h5>
                <p>Verifique o rellene sus datos y pulse siguiente</p>
            </div>

            <form style="width: 95%; padding: 40px;">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" style="background-color: #1e1f1e !important; border: none; border-bottom: 1px solid white; color:white"
                     v-model="email">
                    <div class="input-errors" v-for="error of v$.email.$errors" :key="error.$uid">
                        <div class="error-msg" style="color:red">{{ error.$message }}</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Fecha de nacimiento</label>
                    <VueDatePicker v-model="date"
                        :month-change-on-scroll="true"
                        :close-on-auto-apply="true"
                        locale="es" 
                        format="dd/MM/yyyy"
                        model-type="yyyy-MM-dd"
                        auto-apply
                    ></VueDatePicker>
                    <div class="input-errors" v-for="error of v$.date.$errors" :key="error.$uid">
                        <div class="error-msg" style="color:red">{{ error.$message }}</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Numero de cedula o pasaporte</label>
                    <input type="text" class="form-control"  style="background-color: #1e1f1e !important; border: none; border-bottom: 1px solid white; color:white" 
                    v-model="documento">
                    <div class="input-errors" v-for="error of v$.documento.$errors" :key="error.$uid">
                        <div class="error-msg" style="color:red">{{ error.$message }}</div>
                    </div>
                </div>
            </form>

            <div style="width: 100%; border: 1px solid white; margin-top: 20px;"></div>

            <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%; height: 40px; background-color: #4d4b4b; ">
                <div style="display: flex; justify-content: center; width:50% ; border-right: 3px solid white;">
                    <button class="btn btn-inverse" @click="prev" style="width: 100%;  color: white">
                        PREVIO
                    </button>
                </div>
                <div style="display: flex; justify-content: center; width:50% ;" >
                    <button class="btn btn-inverse" @click="next" style="width: 100%; color: white;" :disabled="aceptado == false" >
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

    setup () {
        return { v$: useVuelidate() }
    },

    data(){
        return{
            date:null,
            email:null,
            documento:null,
        }
    },

    validations () {
        return {
            date: { 
                required: helpers.withMessage('Debe escoger una fecha de nacimiento', required)
            },
            email: { 
                required: helpers.withMessage('Debe especificar un correo electronico ', required),
                //email: helpers.withMessage('Debe especificar un correo electronico valido ', email),
            },
            documento: { 
                required: helpers.withMessage('Debe especificar un numero de cedula o pasaporte ', required),
                numeric: helpers.withMessage('Debe especificar un numero de cedula o pasaporte valido ', numeric),
                minLength: helpers.withMessage('Debe especificar un numero de cedula o pasaporte valido ', minLength(3) ),
            }
        }
    },

    methods:{
        next(  ){
            this.v$.$validate()

            if( this.v$.$invalid == false )
                this.$emit('formSet', { email: this.email, date: this.date, documento: this.documento })
        },

        prev(){
            this.email = null
            this.date = null
            this.documento = null
            this.$emit('prev')
        }
    }
}
</script>

<style>
    .dp__input_wrap input{
        background-color: #1e1f1e !important;
        color: white !important;
        border: none !important;
        border-bottom: 1px solid white !important ;
    }
</style>