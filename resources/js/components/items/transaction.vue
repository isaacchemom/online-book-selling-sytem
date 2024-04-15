
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
                <h6 class="text-danger">Are you sure you want to delete this items?</h6>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" @click="removeItem">Delete</button>
            </div>
        </div>
    </div>
</div>
<!--
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
                                <input type="text" class="form-control" v-model="category.name" required pattern="[A-Za-z\s]+" placeholder="e.g consumables, learning materials">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" v-model="category.description" placeholder="Optional">
                            </div>

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
-->
<!--

<hr>
<div class="ml-4">

    <h5 class="text-center">TRANSACTIONS</h5> -->



 <vue-good-table

  :columns="columns"
  :rows="transaction"
  :fixed-header="false"
  :line-numbers="true"
  max-height="500px"
  :search-options="{
    enabled: true,
    placeholder: 'Search',
  }"
  :pagination-options="{
    enabled: true,
    perPage: 15,
  }"
 styleClass="vgt-table striped condensed  table-hover"
>

<template #table-row="props">
      <span v-if="props.column.field === 'actions'">
        <button v-if="props.row.status === 3" @click="deleteRow(props.row)" class="btn"><i class=" fa fa-trash text-danger ml-4">Delete</i></button>
        <button v-if="props.row.status === 0" @click="deleteRow(props.row)" class="btn"><i class=" fa fa-trash text-danger ml-4">Delete</i></button>
      </span>

      <span v-if="props.column.field === 'status'">
        <p v-if="props.row.status === 3"  class="text-danger">INCOMPLETE</p>
      </span>
      <span v-if="props.column.field === 'status'">
        <p v-if="props.row.status === 1" class="text-success"  >COMPLETED</p>
      </span>
      <span v-if="props.column.field === 'status'">
        <p v-if="props.row.status === 0" class="text-warning"  >PENDING</p>
      </span>

      <span v-else>{{ props.formattedRow[props.column.field] }}</span>
    </template>


</vue-good-table>


    <!-- <table class="table table-stripped table-hover ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">TRANSACTION ID</th>
                    <th scope="col">USER&nbsp;PHONE</th>

                    <th scope="col">EMAIL</th>
                    <th scope="col">ITEM DESCRIPTION</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">DATE</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="(trans, index) in transaction" v-bind:key="index">
                    <td> {{ index+1 }} </td>
                    <td> {{ trans.transaction_id }} </td>
                    <td>{{ trans.phone }}</td>
                    <td>{{ trans.email }}</td>
                    <td>{{ trans.items.desc}}</td>
                    <td>{{ trans.items.price}}</td>

                    <td v-if="trans.status==0"  class="text-warning"> Pending</td>
                     <td v-else-if="trans.status==1" class="text-success">Completed</td>
                     <td v-else class="text-danger">INCOMPLETE</td>
                     <td >{{trans.created_at}}</td>

                    <td> <input type="text" v-model="myform.name[task.id]"></td> -->
    <!--<td>

                           <input @onblur="update(task,$event.target.value)" >-
                          <a href="#" @click.prevent="updates(task)"><i class="fa fa-edit"></i></a>
                        </td>
                   <td v-if="trans.status==3">  <a href="#" @click.prevent="updateCategory(category)"><i class="fa fa-edit"></i></a>
                        <a href="#" @click.prevent="deleteTransaction(trans)"><i class="fa fa-trash text-danger ml-4">Delete</i></a>
                    </td>
                </tr>
            </tbody>
        </table> -->
<!--</div>-->

</template>

<script>
// import { format, parseISO } from 'date-fns'; // Import necessary functions
//import axios from 'axios';
//import mynav from '../nav.vue'
export default {
    // components: {
    // mynav,

    // },
    data() {
        return {
            transactions: {
                name: '',
                description: ''
            },
            showAlert: false,


            editMode: false,
            categories: [],
            transaction: [],
            // message:false

             columns: [{
                    label: 'Phone',
                    field: 'phone',
                },
                {
                    label: 'Email',
                    field: 'email',

                },
                {
                    label: 'Transaction id',
                    field: 'transaction_id',

                },
                {
                    label: 'Description',
                    field: 'items.desc',

                },
                {
                    label: 'Price',
                    field: 'items.price',

                },
                {
                    label: 'Status',
                    field: 'status',
                   // formatFn: this.formatFn,

                },

                {
                    label: 'Created On',
                    field: 'created_at',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd\'T\'HH:mm:ss.SSSSSSxxx',
                    dateOutputFormat: 'MMM do yyyy, HH:mm:ss',
                },

                { label: 'Actions',
                 field: 'actions'
                 }



            ],

        }

    },

    created() {
        this.getCategories()

    },
    methods: {

       // formatFn(value) {
          //  return value === 1 ? 'Completed' : value === 3 ? 'Incomplete' : 'Pending';
    //},


    deleteRow(row) {
      // Handle delete logic here, e.g., show a confirmation dialog
      //console.log('Delete row:', row);
     // this.Transactions.id =row.id;
     // alert(this.Transactions.id );
     const id = row.id;
     this.transactions.id=id;

     $("#deleteModal").modal("show");
    //console.log('id:', this.transactions.id);

    },

        deleteTransaction(trans) {
            //this.editMode = false

            this.transactions.idx = trans.id;
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

        removeItem() {
            this.$emitter.emit('changeLoaderStatus', true)
            // var data = new FormData(formOnes);
            axios.post("https://sabinelibrary.chukahighschool.sc.ke/api/deleteTransaction/" + this.transactions.id).then(response => {

                $("#deleteModal").modal("hide");
                //this.category.value=this.category.value.filter(category.id!==this.category.id)

                this.$toast.success(`Deleted successfully`, {
                    position: "top",
                    dismissible: false
                })
                this.transaction = this.transaction.filter((transactions) => transactions.id !== this.transactions.id);

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

    },

}
</script>


<style></style>
