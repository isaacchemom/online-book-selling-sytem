<template>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">TOTAL PAYMENTS
                            <div class='huge'>KSH {{ totalAmounts }}</div>

                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">

                            <a class="small text-white stretched-link" href="#">
                                <div class='huge'> </div>VIEW
                            </a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">ITEMS UPLOADED

                            <div class='huge'>{{ numb }}</div>

                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">

                            <a class="small text-white stretched-link" href="#">
                                <div class='huge'> </div>VIEW
                            </a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">TOTAL SALES

                            <div class='huge'> {{itemcount}}</div>

                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">

                            <a class="small text-white stretched-link" href="#">
                                <div class='huge'> </div>VIEW
                            </a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">CATEGORIES

                            <div class='huge'>{{ categorycount }} </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">

                            <a class="small text-white stretched-link" href="#">
                                <div class='huge'> </div>viewed results
                            </a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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
            totalAmount: 2,

            editMode: false,
            categories: [],
            transaction: [],
            payment: [],
            items: [],
            // message:false

        }

    },

    mounted() {
        this.getCategories()
        this.getpayment()
        this.getItems()
        this.getTransactions()
        //  this.totalAmounts();

    },
    computed: {
        totalAmounts() {
            return this.payment.reduce((total, payments) => total + parseFloat(payments.amount), 0);
        },
        numb() {
            return this.items.length;
        },
        categorycount() {
            return this.categories.length;
        },
        itemcount() {
            return this.payment.length;
        }
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

        getTransactions() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("https://sabinelibrary.chukahighschool.sc.ke/api/transactions").then(response => {
                this.transaction = response.data.data;

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

        getpayment() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("/payments").then(response => {
                this.payment = response.data.data;
                this.totalAmounts();

                this.$emitter.emit('changeLoaderStatus', false)
            })

        },

        getItems() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("https://sabinelibrary.chukahighschool.sc.ke/api/getItems").then(response => {
                this.items = response.data.data;

                this.$emitter.emit('changeLoaderStatus', false)
            })

        },
        getCategories() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("https://sabinelibrary.chukahighschool.sc.ke/api/getCategories").then(response => {
                this.categories = response.data.data;

                this.$emitter.emit('changeLoaderStatus', false)
            })

        },

    },

}
</script>

<style></style>
