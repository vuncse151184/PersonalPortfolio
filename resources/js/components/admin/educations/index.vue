<script setup>
import axios from 'axios';

import { onMounted,ref } from 'vue';
import Base from '../layouts/base.vue'

onMounted(async() => {
    getEducations();
})

let form = ref({
    instituation:'',
    period:'',
    degree:'',
    department:''
})

let educations=ref([])

const showModal= ref(false)
const hideModal= ref(true)
const editMode = ref(false)

const openModal= () =>{
    showModal.value = !showModal.value
    editMode.value=false

}

const closeModal=()=>{
    showModal.value =! hideModal.value
    form.value=({})
}

const getEducations = async()=>{
    let response= await axios.get('/api/get_all_education')
    educations.value= response.data.educations
}

const createEducation = async()=>{
    let response = await axios.post('/api/create_education',form.value)

    if(response){
        getEducations()
        closeModal()
        toast.fire({
            icon:'success',
            title:'Add education successful'
        })
    }
}

const editModal=(item)=>{
    editMode.value = true
    showModal.value= !showModal.value
    form.value= item
}

const updateEducation = async()=>{
    let response = await axios.post(`/api/update_education/${form.value.id}`,form.value)
    if(response){
        getEducations()
        closeModal()
        toast.fire({
            icon:'success',
            title:'Update education successful'
        })
    }
}

const deleteEducation = (id)=>{


    Swal.fire({
        title:'Are you sure to delete this education?',
        text:'You can not go back',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, I delete it!'

    })
    .then((result)=>{
        if(result.value){
            axios.get('/api/delete_education/'+id)
            .then({
                icon:'succes',
                title:'Delete education success'
            })
            getEducations()
        }
    })
}

</script>
<template>
    <Base/>
    <main>
        <div class="main__sideNav"></div>
            <!-- Main Content -->
        <div class="main__content">
            <section class="educations section" id="educations">
                <div class="skills_container">
                    <div class="titlebar">
                        <div class="titlebar_item">
                            <h1>Educations </h1>
                        </div>
                        <div class="titlebar_item">
                            <div class="btn "  @click="openModal()">
                                New Education
                            </div>
                        </div>
                    </div>

                    <div class="table">

                        <div class="table_filter">
                            <span class="table_filter-Btn ">
                                <i class="fas fa-ellipsis-h"></i>
                            </span>
                            <div>
                                <ul class="table_filter-list">
                                    <li>
                                        <p class="table_filter-link table_filter-link--active">
                                            All
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="table_search">
                            <div class="table_search-wrapper">
                                <select class="table_search-select" name="" id="">
                                    <option value="">Filter</option>
                                </select>
                            </div>
                            <div class="relative">
                                <i class="table_search-input--icon fas fa-search "></i>
                                <input class="table_search--input" type="text" placeholder="Search Education">
                            </div>
                        </div>

                        <div class="education_table-heading">
                            <p>Institution</p>
                            <p>Period</p>
                            <p>Degree</p>
                            <p>Department</p>
                            <p>Actions</p>
                        </div>
                        <!-- item 1 -->
                        <div class="education_table-items" v-for="item in educations" :key="item.id" v-if="educations.length >0">
                            <p>{{item.instituation}}</p>
                            <p>{{item.period}}</p>
                            <p>{{item.degree}}</p>
                            <p>{{item.department}}</p>
                            <div>
                                <button class="btn-icon success" @click="editModal(item)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-icon danger" @click="deleteEducation(item.id)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
                <!-------------- EDUCATION MODAL --------------->
                <div class="modal main__modal " :class="{show: showModal}">
                    <div class="modal__content">
                        <span class="modal__close btn__close--modal"  @click="closeModal()">×</span>
                        <h3 class="modal__title" v-show="editMode==false">Add Education</h3>
                        <h3 class="modal__title" v-show="editMode==true">Update Education</h3>
                        <hr class="modal_line"><br>
                        <form @submit.prevent="editMode ? updateEducation() : createEducation()">
                            <div>
                                <p>Institution</p>
                                <input type="text" class="input" v-model="form.instituation" />

                                <p>Period</p>
                                <input type="text" class="input" v-model="form.period" />

                                <p>Degree</p>
                                <input type="text" class="input" v-model="form.degree" />

                                <p>Department</p>
                                <input type="text" class="input" v-model="form.department" />

                            </div>
                            <br><hr class="modal_line">
                            <div class="model__footer">
                                <button class="btn mr-2 btn__close--modal" @click="closeModal()">
                                    Cancel
                                </button>
                                <button class="btn btn-secondary btn__close--modal " v-show="editMode==false">Save</button>
                                <button class="btn btn-secondary btn__close--modal " v-show="editMode==true">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </main>
</template>
