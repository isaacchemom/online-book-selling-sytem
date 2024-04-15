<template>
    <!-- delete modal -->
    <div v-if="showAlert">
        <div v-if="message">
            <h5 class="alert alert-danger  containerx "> {{ message}} </h5>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DELETE?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-warning">Are you sure you want to delete this category with its related items?</h6>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" @click="removeCategory">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div style="background-color:white;" class="mt-4 ml-4 mr-4">

        <hr />

        <div class="modal fade" id="taskmodal" tabindex="-1" role="dialogx" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centred modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="taskModalLabel">{{ !editMode ? 'Add Category.' : 'Update Category' }}</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div v-if="showAlert">
                        <div v-if="importErrors">
                            <p class="alert alert-danger col-md-8"> {{ importErrors }} </p>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 m-auto" ref="form" @submit.prevent="!editMode ? saveCategory() : editCategory()">
                            <div class="col-md-6">
                                <label class="form-label">NAME</label>
                                <input type="text" class="form-control" v-model="category.name" required  placeholder="e.g SCHEMES OF WORK, LESSON PLANS">
                            </div>

                         <!--   <div class="col-md-6">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" v-model="category.description" placeholder="Optional">
                            </div> -->

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">
                                    {{ !editMode ? 'Save' : 'Update' }}</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <hr>
    <div class="ml-4">

        <button @click="newcategory" class=" btn btn-primary">Add New </button>
        <h4 class="text-center">LIST OF CATEGORIES</h4>
        <table class="table table-stripped table-hover ">
            <thead>
                <tr>
                    <th scope="col">#</th>

                    <th scope="col">Name</th>

                    <th scope="col">Option</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="(category , index) in categories" v-bind:key="index">
                    <td scop="row"> {{ index+1 }} </td>
                    <td> {{ category.name }} </td>
                    <!--<td>{{ category.description }}</td> -->

                    <!---<td> <input type="text" v-model="myform.name[task.id]"></td> -->
                    <!--<td>

                           <input @onblur="update(task,$event.target.value)" >-
                          <a href="#" @click.prevent="updates(task)"><i class="fa fa-edit"></i></a>
                        </td>-->
                        <td style="white-space: nowrap;">
                         <a href="#" @click.prevent="updateCategory(category)"><i class="fa fa-edit"></i></a>
                        <a href="#" @click.prevent="deleteCategory(category)"><i class="fa fa-trash text-danger ml-4"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </template>

    <script>
    //import axios from 'axios';
    //import mynav from '../nav.vue'
    export default {
        // components: {
        // mynav,

        // },
        data() {
            return {
                category: {
                    name: '',
                    description: ''
                },
                showAlert: false,

                editMode: false,
                categories: [],
                // message:false

            }

        },

        mounted() {
            this.getCategories()
        },
        methods: {

            deleteCategory(deleteCategory) {
                //this.editMode = false

                this.category.id = deleteCategory.id;
                $("#deleteModal").modal("show");
            },

            newcategory() {

                this.editMode = false
                this.category = {
                    name: '',
                    description: '',

                };

                $("#taskmodal").modal("show");
                //this.categories.push(this.category);
            },

            updateCategory(mycategory) {
                //console.log(supplier);
                this.category = ''
                this.editMode = true;
                $("#taskmodal").modal("show");
                this.category = mycategory;
            },

            removeCategory() {
                this.$emitter.emit('changeLoaderStatus', true)
                // var data = new FormData(formOnes);
                axios.post("https://sabinelibrary.chukahighschool.sc.ke/api/deleteCategory/" + this.category.id).then(response => {

                    $("#deleteModal").modal("hide");
                    //this.category.value=this.category.value.filter(category.id!==this.category.id)

                    this.$toast.success(`Deleted successfully`, {
                        position: "top",
                        dismissible: false
                    })
                    this.categories = this.categories.filter((category) => category.id !== this.category.id);

                    this.$emitter.emit('changeLoaderStatus', false)
                }).catch(error => {

                    //alert("Error in uploading,check your file type and try gain!");

                    if (error.response && error.response.status === 500) {

                        this.importErrors = error.response.data.error;
                        this.showAlert = true;

                        setTimeout(() => {
                            this.showAlert = false;
                        }, 5000);

                        //console.log('Errors:', this.errors);
                    } else if (error.response.status === 422) {

                        this.message = error.response.data.message;
                        this.showAlert = true;
                        $("#deleteModal").modal("hide");
                        setTimeout(() => {
                            this.showAlert = false;
                        }, 7000);
                    } else {
                        //console.error('Unknown errors:', error);
                        // alert('check file again')
                        this.$toast.error(`serverError! try again!`, {
                                position: "top"

                            }

                        )
                    }
                    this.$emitter.emit('changeLoaderStatus', false)

                });

            },

            saveCategory() {

                this.$emitter.emit('changeLoaderStatus', true)

                axios.post("https://sabinelibrary.chukahighschool.sc.ke/api/addCategory", this.category).then(response => {

                    this.$toast.success(`Category added successfully`, {
                        position: "top",
                        dismissible: false
                    })
                    $("#taskmodal").modal("hide");

                    // this.categories='';

                    this.$emitter.emit('changeLoaderStatus', false);
                    this.categories.push(this.category);

                }).catch(error => {

                    if (error.response && error.response.status === 500) {
                        this.importErrors = error.response.data.error;
                        this.showAlert = true;

                        setTimeout(() => {
                            this.showAlert = false;
                        }, 5000);

                    } else {

                        this.$toast.error(`serverError! try again!`, {
                                position: "top"

                            }

                        )
                    }
                    this.$emitter.emit('changeLoaderStatus', false)

                });
            },

            getCategories() {
                this.$emitter.emit('changeLoaderStatus', true)
                axios.get("https://sabinelibrary.chukahighschool.sc.ke/api/getCategories").then(response => {
                    this.categories = response.data.data;

                    this.$emitter.emit('changeLoaderStatus', false)
                })

            },

            editCategory() {

                this.$emitter.emit('changeLoaderStatus', true)
                axios.patch("https://sabinelibrary.chukahighschool.sc.ke/api/updateCategory/" + this.category.id, this.category).then(() => {

                    this.$toast.success(`Updated successfully`,

                        {
                            position: "top",
                            dismissible: false

                        }

                    )

                    this.$emitter.emit('changeLoaderStatus', false);
                    $("#taskmodal").modal("hide");

                }).finally(() => {
                    $("#taskModal").modal("hide")
                }).catch(error => {

                    if (error.response && error.response.status === 500) {
                        this.importErrors = error.response.data.error;
                        this.showAlert = true;

                        setTimeout(() => {
                            this.showAlert = false;
                        }, 5000);
                        //console.log('Errors:', this.errors);
                    } else {
                        //console.error('Unknown errors:', error);
                        // alert('check file again')
                        this.$toast.error(`Error! try again!`, {
                                position: "top"

                            }

                        )
                    }
                    this.$emitter.emit('changeLoaderStatus', false)

                }).finally(() => {
                    $("#taskModal").modal("hide");
                });
            },

        },

    }
    </script>

    <style></style>
