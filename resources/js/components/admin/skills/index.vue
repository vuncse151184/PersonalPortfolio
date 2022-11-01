<script setup>
    import Base from '../layouts/base.vue'
    import {onMounted,ref} from 'vue'

    let skills=ref([]);
    let services=ref([])

    const showModal= ref(false)
    const hideModal= ref(true)
    const editMode= ref(false)
    let form = ref({
        name :'',
        proficiency :'',
        service_id :''
    })

    onMounted(async()=>{
        getSkills(),
        getService()
    })


    const getSkills = async()=>{
        let response = await axios.get('/api/get_all_skill')
        skills.value= response.data.skills
    }

    const getService = async()=>{
        let response = await axios.get('/api/get_all_services')
        services.value = response.data.services
    }

    const createSkills = async()=>{
        editMode.value=false
        let response = await axios.post('/api/create_skill',form.value)
        if(response){
            getSkills()
            closeModal()
            toast.fire({
                icon:"success",
                title:"Skill creates successfully"
            })
        }
    }

    const deleteSkill = (id)=>{
        Swal.fire({
        title:"Are you sure to delete this service?",
        text:"You can't go back",
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, I delete it!'
        })
        .then((result)=>{
            if(result.value){
                axios.get('/api/delete_skill/'+id)
                .then(()=>{
                    Swal.fire(
                        'Delete',
                        'Skill delete Successfully',
                        'success',
                    )
                    getSkills()
                })
            }
        })
    }

    const editModal=(item)=>{

        editMode.value=true;
        showModal.value= !showModal.value
        form.value = item
    }

    const updateSkill = async() =>{
        let response = await axios.post(`/api/update_skill/${form.value.id}`,form.value)
        if(response){
            getSkills()
            closeModal()
            toast.fire({
                icon:'success',
                title:'skill updates successfully'
            })
        }
    }

    const openModal = () =>{
        showModal.value = !showModal.value
    }

    const closeModal = () =>{
        showModal.value = !hideModal.value
        form.value =({}) // clear form
        editMode.value= false
    }

</script>

<template>
    <Base/>
    <main>

        <div class="main__sideNav"></div>
            <!-- Main Content -->
        <div class="main__content">
            <!--==================== SKILLS ====================-->
            <section class="skills section" id="skills">
                <div class="skills_container">
                    <div class="titlebar">
                        <div class="titlebar_item">
                            <h1>Skills </h1>
                        </div>
                        <div class="titlebar_item" >
                            <div class="btn btn__open--modal" @click="openModal()">
                                New Skill
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
                                <input class="table_search--input" type="text" placeholder="Search Service">
                            </div>
                        </div>

                        <div class="skill_table-heading">
                            <p>Name</p>
                            <p>Proficiency</p>
                            <p>Service</p>
                            <p>Actions</p>
                        </div>
                        <!-- item 1 -->
                        <div class="skill_table-items" v-for="item in skills" :key="item.id" v-if=" skills.length > 0">
                            <p>{{item.name}}</p>
                            <div class="table_skills-bar">
                                 <span class="table_skills-percentage" :style="{'width': `${item.proficiency}%`}"></span>
                                 <strong>{{item.proficiency}}%</strong>
                            </div>
                            <p v-if="item.service"> {{item.service.name}}</p>
                            <div>
                                <button class="btn-icon success" @click="editModal(item)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-icon danger" @click="deleteSkill(item.id)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                        <!-- <div class="service_table-items" v-for="item in services" :key="item.id" v-if="services.length >0">
                            <p>{{item.name}}</p>
                            <button class="service_table-icon">
                              <i class=" {{item.icon}}"></i>
                            </button>
                            <p>{{item.description}}
                            </p>
                            <div>
                                <button class="btn-icon success" @click="editModal(item)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-icon danger" @click="deleteModal(item.id)" >
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div> -->



                    </div>

                </div>
                <!-------------- SERVICES MODAL --------------->
                <div class="modal main__modal " v-bind:class="{show: showModal}">
                    <div class="modal__content">
                        <span class="modal__close btn__close--modal" @click="closeModal()">×</span>
                        <h3 class="modal__title" v-show="editMode==false">Add Skill</h3>
                        <h3 class="modal__title" v-show="editMode==true">Update Skill</h3>
                        <hr class="modal_line"><br>
                        <form @submit.prevent="editMode ? updateSkill(): createSkills()">
                            <div>
                                <p>Name</p>
                                <input type="text" class="input" v-model="form.name" />

                                <p>Proficiency</p>
                                <input type="text" class="input" v-model="form.proficiency"/>

                                <p>Service</p>
                                <select class="inputSelect" name="" id=""  v-model="form.service_id" >
                                    <option selected="selected" disabled>Select service </option>
                                    <option :value="service.id" v-for="service in services" :key="service.id">
                                        {{service.name}}
                                    </option>
                                </select>
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

            <!--==================== SKILLS ====================-->
            <section class="skills section" id="skills">

            </section>
        </div>
    </main>

</template>

<style>
    /*==================== REUSEABLE ====================*/
.titlebar {
  display:flex;
  justify-content:space-between;
  align-items: center;
  margin-top: 10px;
}

.titlebar_item,h1,button {
  margin-top: 10px;
  margin-bottom: 10px;
}

.table {
  background: #FFF;
  margin-top: 20px;
  margin-bottom: 30px;
}

.table_filter {
  border-bottom: 1px solid #e0e0e0;
  padding: 10px 20px;
  margin-bottom: 20px;
}

.table_filter-Btn {
  display: none;
}

.table_filter-list {
  display: flex;
  justify-content: flex-start;
  list-style: none;
}

.table_filter-link {
  margin-right: 1rem;
}

.table_filter-link--active {
  color: #006fbb;
  font-weight: 500;
}

ul {
  list-style: none;
}

.table_search {
  padding: 0 20px;
  display: grid;
  grid-template-columns: minmax(150px, auto) minmax(180px, 1fr);
}

.table_search-wrapper {
  position: relative;
}

.table_search-select {
  appearance: none;
  background: #eeeeee;
  color: #6a727a;
  width: 100%;
  border: none;
  border-top: 1px solid #e0e0e0;
  border-left: 1px solid #e0e0e0;
  border-bottom: 1px solid #e0e0e0;
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 20px;
  padding-right: 20px;

}

.relative {
  position: relative;
}

.table_search-input--icon {
  top: 12px;
  left: 2px;
  color: #d4d4d4;
  position: absolute;
}

.table_search-input {
  width: 100%;
  border: none;
  color: #454f5b;
  border-top: 1px solid #e0e0e0;
  border-right: 1px solid #e0e0e0;
  border-bottom: 1px solid #e0e0e0;
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-right: 20px;
  padding-left: 40px;

}

.card_wrapper {
  display: grid;
  grid-template-columns: 1fr minmax(auto, 290px);
  grid-gap: 20px;
}

.card {
  background: white;
  padding: 20px 20px 20px 20px;
  border: 1px solid #e0e0e0;
  box-shadow: 0 6px 13px -12px rgb(50 50 93 / 20%), 0 3px 7px -3px rgb(110 110 110 / 10%);
  border-radius: 4px;
}

.card,p {
  margin-top: 10px;
  margin-bottom: 10px;
}

.card,input {
  padding: 9px 15px;
  border: 1px solid #e0e0e0;
  border-radius: 4px;
  width: 100%;
}

.card,textarea {
  padding: 9px 15px;
  border: 1px solid #e0e0e0;
  border-radius: 4px;
  width: 100%;
  font-size: 1.1rem;
  font-family: 'Open Sans', 'Helvetica News', sans-serif;
}

.hr {
  margin-top: 30px;
  margin-bottom: 30px;
}

.br {
  margin-top: 40px;
}

.inputSelect {
  padding: 9px 15px;
  border: 1px solid #e0e0e0;
  border-radius: 4px;
  width: 100%;
  color: #454f5b;
  min-width: 200px;
}
</style>
