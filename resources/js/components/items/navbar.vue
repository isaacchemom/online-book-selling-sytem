<template>
     <nav class=" containerx navbar navbar-expand-lg navbar-dark bg-successx mt-2" style="background-color: rgb(21, 181, 90)">
        <div class="container px-4 px-lg-5">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 ">
                    <li class="nav-item"><a class="nav-link active " aria-current="page" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Recently
                            added</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('itemCategory', 4)}}">Schemes of
                            work</a></li>

                            <li class="nav-item text-white">
                            <router-link to="/admin/payment" class="nav-link-active" active-current="page">
                             PAYMENTS




                    </router-link></li>


                    <li  v-for="category in categories" :key="category.id" class="nav-item">
                        <a class="nav-link active" aria-current="page" href="" @click.prevent="callControllerFunction(category.category_id)"> {{category.categories.name}}
                        </a>
                    </li>

                        <!--
                            <li v-for="category in categories" :key="category.id" class="nav-item text-white">
                            <router-link to="/getItems+4" class="nav-link-active" active-current="page">
                             {{category.categories.name}}




                    </router-link>
                </li>  -->

                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Exams & home
                            work</a></li>
                            <!--
                            @if($check==2)
                            @foreach($bookss as $category)
                            <li class="nav-item"><a class="nav-link active"   href="{{route('itemCategory', $category->category_id  )}}">{{ $category->categories->name }}</a></li> <li class="nav-item"><a class="nav-link active"   href="{{route('itemCategory', $category->category_id  )}}">{{ $category->categories->name }}</a></li> <li class="nav-item"><a class="nav-link active"   href="{{route('itemCategory', $category->category_id  )}}">{{ $category->categories->name }}</a></li>
                        @endforeach
                              @else
                              @foreach($bookss1 as $category1)
                            <li class="nav-item"><a class="nav-link active"   href="{{route('itemCategory', $category1->category_id  )}}">{{ $category1->categories->name }}</a></li>
                        @endforeach
                        @endif -->

                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Record of
                            work</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="color:white ">Lesson plans</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/">Termly lesson plans</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li><a class="dropdown-item" href="/">General lesson plans</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                        </ul>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="color:white ">Notes</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/">PRIMARY NOTES</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li><a class="dropdown-item" href="/">SECONDARY NOTES</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                        </ul>
                    </li>




                </ul>

            </div>

        </div>

    </nav>
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
                items: [],
                categoryId:'',
                // message:false

            }

        },

        mounted() {
            this.getCategories()
        },
        methods: {
            callControllerFunction(myid) {
      // Send parameters to the Laravel route here
      this.categoryId=myid;
      //alert(this.categoryId);

      // Make an API request to your Laravel backend
      axios.post("https://sabinelibrary.chukahighschool.sc.ke/api/getItems/"+this.categoryId)
        .then(response => {
          this.items = response.data.data; // Update the items with the response data
          alert('success');

          window.location.href = "{{ route('welcome') }}";
        })
        .catch(error => {
          // Handle errors

          alert('error boy');
        });
    },




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
                axios.get("https://sabinelibrary.chukahighschool.sc.ke/api/getMyItem").then(response => {
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
