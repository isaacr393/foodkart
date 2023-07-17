<template>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height:100%; ">        
        
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 70%; 
                    background-color: #1e1f1e; color: white; border-radius: 20px; overflow: hidden; ">            
            
            <div style="background-color: #1e1f1e; width: 100%; height: 100px; padding: 20px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <h5>Detalles personales</h5>
                <p>Verifique o rellene sus datos y pulse siguiente</p>
            </div>

            <form style="width: 95%; padding: 40px;">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input type="text" class="form-control" style="background-color: #1e1f1e !important; border: none; border-bottom: 1px solid white; color:white"
                     v-model="nombre">
                    <div class="input-errors" v-for="error of v$.nombre.$errors" :key="error.$uid">
                        <div class="error-msg" style="color:red">{{ error.$message }}</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apellido</label>
                    <input type="text" class="form-control" style="background-color: #1e1f1e !important; border: none; border-bottom: 1px solid white; color:white"
                     v-model="apellido">
                    <div class="input-errors" v-for="error of v$.apellido.$errors" :key="error.$uid">
                        <div class="error-msg" style="color:red">{{ error.$message }}</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Alias</label>
                    <input type="text" class="form-control" style="background-color: #1e1f1e !important; border: none; border-bottom: 1px solid white; color:white"
                     v-model="alias">
                    <div class="input-errors" v-for="error of v$.alias.$errors" :key="error.$uid">
                        <div class="error-msg" style="color:red">{{ error.$message }}</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Sexo</label>
                    <div style="display: flex; justify-content: space-around; border: 1px solid red">
                        <div style="cursor: pointer; height: 30px; width: 34%; border-radius: 3%; text-align: center;" :class="[sexo == 'M' ? 'activeSex' : 'noActiveSex' ]" @click="setSex('M')"> Hombre </div>
                        <div style="cursor: pointer; height: 30px; width: 33%; border-radius: 3%; text-align: center;" :class="[sexo == 'F' ? 'activeSex' : 'noActiveSex' ]" @click="setSex('F')"> Mujer </div>
                        <div style="cursor: pointer; height: 30px; width: 33%; border-radius: 3%; text-align: center;" :class="[sexo == 'N' ? 'activeSex' : 'noActiveSex' ]" @click="setSex('N')"> Neutral </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Pais</label>
                    <select v-model="pais" class="form-control" style="background-color: #1e1f1e !important; border: none; border-bottom: 1px solid white; color:white" >
                        <option v-for="c in countries" :key="c.code" :value="c.code">{{ c.name }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Telefono movil</label>
                    <input type="text" class="form-control"  style="background-color: #1e1f1e !important; border: none; border-bottom: 1px solid white; color:white" 
                    v-model="telefono_movil">
                    <div class="input-errors" v-for="error of v$.telefono_movil.$errors" :key="error.$uid">
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
import { countries } from './countries'
export default {
    components:{VueDatePicker,},

    setup () {
        return { v$: useVuelidate() }
    },

    data(){
        return{
            nombre:null,
            apellido:null,
            alias:null,
            sexo:'M',
            telefono_movil:null,
            pais:'VE',   
            countries: countries         
        }
    },

    validations () {
        return {
            nombre: { 
                required: helpers.withMessage('Debe indicar su nombre', required)
            },
            apellido: { 
                required: helpers.withMessage('Debe indicar su apellido ', required),
            },
            alias: { 
                required: helpers.withMessage('Debe indicar su alias ', required),
            },
            telefono_movil: { 
                required: helpers.withMessage('Debe especificar un numero telefonico ', required),
                numeric: helpers.withMessage('Debe especificar un numero telefonico valido ', numeric),
                minLength: helpers.withMessage('Debe especificar un numero telefonico valido (solo numeros)', minLength(10) ),
            }
        }
    },

    methods:{
        setSex( sex ){
            this.sexo = sex
        },

        next(  ){
            this.v$.$validate()

            if( this.v$.$invalid == false )
                this.$emit('userRegistered', { 
                    nombre:this.nombre,
                    apellido: this.apellido,
                    alias: this.alias,
                    sexo: this.sexo,
                    telefono_movil: this.telefono_movil,
                    pais: this.pais,
                })
        },

        prev(){
            this.nombre = null
            this.apellido = null
            this.alias = null
            this.sexo = 'M'
            this.telefono_movil = null
            this.pais = 'VE'
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

    .activeSex{
        background: red;
        color: white;
    }

    .noActiveSex{
        background: #1e1f1e;   
        color: white;
    }
</style>