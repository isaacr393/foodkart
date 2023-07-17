<template>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height:100%; ">        
        
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 70%; 
                    background-color: #1e1f1e; color: white; border-radius: 20px; min-height: 400px%; ">            
            
            <div style="background-color: #1e1f1e; width: 100%; height: 100px; padding: 20px; display: flex; flex-direction: column; justify-content: center; align-items: center; border-radius: 20px;">
                <h5>Foto</h5>
                <p>Tomar una foto</p>
            </div>

            <div id="photoReproducer" style="width: 100%; display: flex; justify-content: center; align-items: center; flex-direction: column;">                
                <video id="video" width="80%" height="60%" autoplay></video>                
                <canvas id="canvas" style="display: none; width: 80%; height: auto; margin-bottom: 20px;"></canvas>

                <div style="display: flex; justify-content: center; width: 100%;">
                    <div id="click-photo" style="margin-bottom: 20px; display: none; border-radius: 50%; color: white; background-color: white; width: 50px; height: 50px;" ></div>
                </div>

                <img id="imgUpload" style="width: 80%;">

                <button id="start-camera" style="width: 80%; background-color: red; color: white; border-radius: 5%; height: 30px;"  >Tomar una foto</button>                                
                <button id="uploadFile" @click="uploadFoto" style="width: 80%; background-color: red; color: white; border-radius: 5%; height: 30px; margin-top: 10px;"  >Cargar desde archivo</button>                                
                <input type="file" name="photo" id="upload-photo" style="display:none" />
                <button id="cancel-camera" style="width: 80%; background-color: red; color: white; border-radius: 5%; height: 30px; display: none;"  >Cancelar</button>                                
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
        _this.camera_button = document.querySelector("#start-camera");
        _this.video = document.querySelector("#video");        
        _this.canvas = document.querySelector("#canvas");   
        _this.cancelButtton = document.querySelector("#cancel-camera");
        _this.click_button = document.querySelector("#click-photo");
        _this.uploadFile = document.querySelector("#uploadFile");

        _this.camera_button.addEventListener('click', async function() {
            _this.click_button.style.display = "flex"
            _this.uploadFile.style.display = "none"
            _this.video.style.display = "block"
            _this.camera_button.style.display = "none"        
            _this.cancelButtton.style.display = 'block'
            document.querySelector("#imgUpload").style.display = "none"

            let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
            _this.video.srcObject = stream;            
        });

        _this.click_button.addEventListener('click', function() {

            //console.log(width, height,canvas.width, canvas.height)

            _this.video.style.display = "none"
            _this.canvas.style.display = "block"
            _this.canvas.getContext('2d').drawImage(video, 0, 0,  _this.canvas.width, _this.canvas.height);
            let image_data_url = canvas.toDataURL('image/jpeg'); 
            _this.imageBase64 = image_data_url
            // data url of the image
            //console.log(image_data_url);
                    
            _this.cancelButtton.style.display = 'block'
            _this.click_button.style.display = 'none'
            document.querySelector("#imgUpload").style.display = "none"
            
        });

        _this.cancelButtton.addEventListener('click', async function() { 
            _this.imageBase64 = null
            _this.video.style.display = "block"
            _this.video.srcObject = null
            _this.canvas.style.display = "none"
            _this.cancelButtton.style.display = 'none'
            _this.camera_button.style.display = "block"
            _this.uploadFile.style.display = "block"
            _this.click_button.style.display = "none"
            document.querySelector("#imgUpload").style.display = "none"

        });

        document.querySelector("#upload-photo").addEventListener("change", function(){
            if (!this.files || !this.files[0]) return;
            
            const FR = new FileReader();                
            FR.addEventListener("load", function(evt) {
                document.querySelector("#imgUpload").style.display = "block"
                _this.video.style.display = "none"
                document.querySelector("#imgUpload").src         = evt.target.result;
                //document.querySelector("#b64").textContent = evt.target.result;
                //console.log( evt.target.result )
                _this.imageBase64 = evt.target.result                
            });                 
            FR.readAsDataURL(this.files[0]);
        })
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
</style>