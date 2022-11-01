<script setup>
    import Base from '../layouts/base.vue';
    import { onMounted,ref } from 'vue';
    import axios from 'axios';

    onMounted(async()=>{
        getExperience()
    })

    const showModal = ref(false)
    const hideModal = ref(true)

    let form= ref({
        company:'',
        period:'',
        position:''
    })

    let experiences=ref([])
    const getExperience = async() =>{
        let response= await axios.get('/api/get_all_experience')
        experiences.value= response.data.experiences
    }

    const openModal = () =>{
        showModal.value = !showModal.value
    }

    const closeModal = () =>{
        showModal.value = !hideModal.value
    }

    const createExperience = 
</script>
<template>
    <Base/>
    <main>
        <div class="main__sideNav"></div>
            <!-- Main Content -->
        <div class="main__content">

            <!--==================== EXPERIENCES ====================-->
            <section class="experiences section" id="experiences" >
                <div class="skills_container">
                    <div class="titlebar">
                        <div class="titlebar_item">
                            <h1>Experiences </h1>
                        </div>
                        <div class="titlebar_item">
                            <div class="btn btn__open--modal"  @click="openModal()">
                                New Experience
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
                                <input class="table_search--input" type="text" placeholder="Search Experience">
                            </div>
                        </div>

                        <div class="experience_table-heading">
                            <p>Company</p>
                            <p>Period</p>
                            <p>Position</p>
                            <p>Actions</p>
                        </div>
                        <!-- item 1 -->
                        <div class="experience_table-items" v-for="item in experiences" :key="item.id" v-if="experiences.length >0">
                            <p>{{item.company}}</p>
                            <p>{{item.period}}</p>
                            <p>{{item.position}}</p>
                            <div>
                                <button class="btn-icon success">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-icon danger" >
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
                <!-------------- EXPERIENCE MODAL --------------->
                <div class="modal main__modal " :class="{show: showModal}">
                    <div class="modal__content">
                        <span class="modal__close btn__close--modal"  @click="closeModal()">×</span>
                        <h3 class="modal__title">Add Experience</h3>
                        <hr class="modal_line"><br>
                        <div>
                            <p>Company</p>
                            <input type="text" class="input" v-model="form.company"/>

                            <p>Period</p>
                            <input type="text" class="input" v-model="form.period"/>

                            <p>Position</p>
                            <input type="text" class="input" v-model="form.position"/>

                        </div>
                        <br><hr class="modal_line">
                        <div class="model__footer">
                            <button class="btn mr-2 btn__close--modal" @click="closeModal()">
                                Cancel
                            </button>
                            <button class="btn btn-secondary btn__close--modal ">Save</button>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>
</template>
