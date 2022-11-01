<script setup>
import axios from 'axios';
import{ reactive, ref} from 'vue'
import{ useRouter} from 'vue-router'

    const router = useRouter()
    let form = reactive({
        name:'',
        email: '',
        password: '',
        c_password: '',
    })
    let error=ref('')

    const register = async()=>{

        await axios.post('/api/register',form)
            .then(response=>{
                if(response.data.success){
                    localStorage.setItem('token',response.data.data.token)
                    router.push('/page/home')
                }else{
                    error.value = response.data.message;
                }
            })
    }

    const Back =()=>{
        router.push('/page/home')
    }



</script>
<template>
    <div class="login">
        <div class="frmLogin">
            <form >
                <input type="text" placeholder="Enter name" v-model="form.name"/>
                <br>
                <input type="email" placeholder="Enter your Email" v-model="form.email"/>
                <br>
                <input type="password" placeholder="Enter your password" v-model="form.password"/>
                <br>
                <input type="c_password" placeholder="Enter your password again" v-model="form.c_password"/>
                <br>

                <button type="submit" value="Back" class="btnBack" @click="Back">BACK</button>
                <button type="submit" value="Register" class="btnLogin">OK</button>

                <p class="error-tag" v-if="error">{{error}}</p>

            </form>

        </div>
    </div>
</template>
<style>
    .btnBack{
    background: rgba(228,232, 243, 0.8);
    background-position: 0.1em 0.6em;
    border:  none;
    padding: 0;
    margin: 0.5em 0 0 0.5em;
    width: 8em;
    height: 2.8em;
    outline: none;
    transition: background-color 0.4s;
}


</style>
