<script setup>
import axios from 'axios';
import{ reactive, ref} from 'vue'
import{ useRouter} from 'vue-router'


    const router = useRouter()
    let form = reactive({
        email: '',
        password: '',

    })
    let error=ref('')

    const login = async()=>{

        await axios.post('/api/login',form)

            .then(response=>{
                console.log("flag at login.vue:",response.data.success);
                // const res=JSON.parse(response.data);
                // console.log("response data:", res);
                if(response.data.success){
                    localStorage.setItem('token',response.data.data.token)
                    console.log("token at localstorage: ",localStorage.getItem('token'));
                    router.push({ path:'/admin/home'})

                }else{
                    error.value = response.data.message;
                    // console.log("error at login.vue: " ,error.value);
                    // router.push({path:'/'})
                }
            })
    }
</script>
<template>
    <div class="login">
        <div class="frmLogin">
            <form @submit.prevent="login" >
                <input class="input_author" type="email" placeholder="Enter your Email" v-model="form.email"/>
                <br>
                <input class="input_author" type="password" placeholder="Enter your password" v-model="form.password"/>
                <br>
                <button type="submit" value="Login" class="btnLogin">Login</button>
                <p class="error-tag" v-if="error">{{error}}</p>

            </form>

        </div>
    </div>
</template>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Lucida Sans',sans-serif;
    font-size: 12px;
}
.login{
    background: #6c5ce7;
    margin:0;
    padding:0;
    width: 100%;
    height: 100vh;
}
.frmLogin{
    display: flex;
    align-items: center;
    margin: 0;
    width:22.8em;
    height: 100%;
    margin: 0 auto 0 auto;
    overflow: hidden;
}

.input_author{
    background: rgba(228,232, 243, 0.8);
    background-position: 0.5em 0.6em;
    border:  none;
    padding: 0 0 0 1rem;
    margin: 0 0 1em 0;
    width: 30em;
    height: 2.8em;
    outline: none;
    transition: background-color 0.4s;
}
.btnLogin{
    background: rgba(228,232, 243, 0.8);
    background-position: 0.5em 0.6em;
    border:  none;
    padding: 0;
    margin: 1.5em 0 0 5em;
    width: 8em;
    height: 2.8em;
    outline: none;
    transition: background-color 0.4s;
}

.input_author:hover{
    background-color: azure;
}
.input_author:focus{
    background-color: azure;
}
button:hover{
    background-color: azure;
}
.error-tag
{
    color: red;
    font-size: 18px;
    text-align: center;
}
</style>
