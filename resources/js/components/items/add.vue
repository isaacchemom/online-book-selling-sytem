<template>
<!-- DELETE ITEMS  MODAL -->

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
                <h5 class="modal-title">DELETE ITEM?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="alert alert-warning">Are you sure you want to delete item?</h6>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" @click="removeItem">Delete</button>
            </div>
        </div>
    </div>
</div>
<!---end of delete modal-->
<div style="background-color:white;" class="mt-4 ml-4 mr-4">

    <hr />

    <div class="modal fade" id="taskmodal" tabindex="-1" role="dialogx" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centred modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="taskModalLabel">{{ !editMode ? 'Add Item.' : 'Update items' }}</h5>

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
                    <form class="row g-3 m-auto" ref="form" @submit.prevent="!editMode ? saveItem() : editItems()">
                        <div class="col-md-6">
                            <label class="form-label">SUBJECT</label>
                            <input type="text" class="form-control" v-model="item.title" required placeholder="E.G ENGLSIH ,SCIENCE">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">CATEGORY</label>
                            <select v-model="item.categoryId " class="form-control" required>
                                <option value="" disabled>Select a Category</option>
                                <option v-for="category in mycategories" :value="category.id" :key="category.id" :selected="category.id">{{ category.name }}</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">CLASS|GRADE</label>
                            <input type="text" class="form-control" v-model="item.class" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">PRICE</label>
                            <input type="text" class="form-control" v-model="item.price" required>
                        </div>

                        <div class="col-md-6"  v-if="!editMode">
                            <label class="form-label">SELECT FILE</label>
                            <input type="file" @change="selectFile" ref="fileInput" required />

                        </div>
                        <div class="col-md-6">
                            <label class="form-label">DESCRIPTION</label>
                            <textarea type="text" class="form-control" v-model="item.desc"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                {{ !editMode ? 'save Item' : 'Update Item' }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>


<div class="ml-4">
    <button class="btn btn-success" @click="newItem">Add New </button>
<!--
    <h4 class="text-center">LIST OF ITEMS</h4>
    <table class="table table-stripped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">SUBJECT</th>

                <th scope="col">CATEGORY</th>
                <th scope="col">CLASS|GRADE</th>
                <th scope="col">PRICE</th>
                 <th scope="col">FILE</th>--
                <th scope="col">DESCRIPTION</th>
                <th scope="col">DATE</th>
                <th scope="col">OPTIONS</th>

            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in items" v-bind:key="index">
                <td scope="row">{{ index+1}}</td>
                <td scope="row">{{ item.title }}</td>
                <td>{{ item.categories.name}}</td>
                <td>{{ item.class}}</td>
                <td>{{ item.price}}</td>
                <td>{{ item.file_path}}</td>
                <td>{{ item.desc }}</td>

                <td>{{ item.created_at }}</td>
                <td>  <input @onblur="update(task,$event.target.value)"
                      <a href="#" @click.prevent="updates(task)"><i class="fa fa-edit"></i></a>  </td>

                <td style="white-space: nowrap;">

                    <a href="#" @click.prevent="updateItem(item)"><i class="fa fa-edit"></i></a>
                    <a href="#" @click.prevent="deleteItem(item)"><i class="fa fa-trash text-danger  ml-2"></i></a>
                    <a href="#" @click.prevent="downloadItem(item)"><i class="fa fa-download text-success  ml-2 "></i></a>

                </td>
            </tr>
        </tbody>
    </table>
-->
</div>


<vue-good-table

:columns="columns"
:rows="items"
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
        <a href="#" @click.prevent="updateItem(props.row)"><i class="fa fa-edit"></i></a>
      <a href="#" @click.prevent="deleteItem(props.row)"><i class="fa fa-trash text-danger  ml-2"></i></a>
      <a href="#" @click.prevent="downloadItem(props.row)"><i class="fa fa-download text-success  ml-2 "></i></a>

    </span>

    <span v-else>{{ props.formattedRow[props.column.field] }}</span>
  </template>


</vue-good-table>

</template>

<script>
export default {
    // components: {

    data() {
        return {
            // moment: moment,
            fileUrl: null,
            item: {
                title: '',
                class: '',
                price: '',
                file: '',
                // subject: '',
                categoryId: '',
                desc: ''
            },

            showAlert: false,
            //  form: null,
            // edit: false,
            editMode: false,
            items: [],
            mycategories: [],
            suppliers: [],

            columns: [{
                    label: 'subject',
                    field: 'title',
                },
                {
                    label: 'Category',
                    field: 'categories.name',

                },
                {
                    label: 'class',
                    field: 'class',

                },
                {
                    label: 'price',
                    field: 'price',

                },
                {
                    label: 'Description',
                    field: 'desc',

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

    mounted() {

        this.getItems();
        // this.getsuppliers();

        this.getCategories();
    },

    methods: {

        selectFile() {
            this.file = this.$refs.fileInput.files[0];
        },

        newItem() {

            this.editMode = false
            this.item = {
                title: '',
                class: '',
                price: '',
                file: '',
                // subject: '',
                categoryId: '',
                desc: ''
            }

            $("#taskmodal").modal("show");
        },

        updateItem(row) {
            //console.log(supplier);
            //this.item = ''
            const myitem=row;
            this.editMode = true;
            $("#taskmodal").modal("show");
            this.item = myitem;

            // alert('hi boy')

        },

        deleteItem(row) {
            //this.editMode = false
             const myitem=row.id;
            this.item.id = myitem;
            $("#deleteModal").modal("show");
        },
        downloadItemx(row) {
            const id = row.id;
            this.fileID = id;
        },

        saveItem() {

            this.$emitter.emit('changeLoaderStatus', true)
            // var data = new FormData(formOnes);

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            let formData = new FormData();
            formData.append('file', this.file);
            formData.append('title', this.item.title);
            formData.append('class', this.item.class);
            formData.append('price', this.item.price);
            formData.append('categoryId', this.item.categoryId);
            formData.append('desc', this.item.desc);

            axios.post("https://sabinelibrary.chukahighschool.sc.ke/api/addItem", formData, config).then(response => {

                this.$toast.success(`Item Saved successfully`, {
                    position: "top",
                    dismissible: false
                })
                $("#taskmodal").modal("hide");

                this.$emitter.emit('changeLoaderStatus', false);
                this.getItems();
                //this.items.push(this.item);

            }).catch(error => {

                if (error.response && error.response.status === 500) {
                    this.importErrors = error.response.data.error;
                    this.showAlert = true;

                    setTimeout(() => {
                        this.showAlert = false;
                    }, 5000);
                    //console.log('Errors:', this.errors);
                } else {

                    this.$toast.error(`serverError! try again!`, {
                            position: "top"

                        }

                    )
                }
                this.$emitter.emit('changeLoaderStatus', false)

            });
        },

        getItems() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("https://sabinelibrary.chukahighschool.sc.ke/api/getItems").then(response => {
                this.items = response.data.data;

                this.$emitter.emit('changeLoaderStatus', false)
            })

        },

        editItems() {

            this.$emitter.emit('changeLoaderStatus', true)
            axios.patch("https://sabinelibrary.chukahighschool.sc.ke/api/updateItems/" + this.item.id, this.item).then(() => {

                this.$toast.success(`Saved successfully`,

                    {
                        position: "top",
                        dismissible: false

                    }

                )
                $("#taskmodal").modal("hide");

                this.$emitter.emit('changeLoaderStatus', false)

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

        // function to fetch categories for selection on item selcetion form
        getCategories() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("https://sabinelibrary.chukahighschool.sc.ke/api/getCategories").then(response => {
                this.mycategories = response.data.data;

                this.$emitter.emit('changeLoaderStatus', false)
            })

        },

        removeItem() {
            this.$emitter.emit('changeLoaderStatus', true)
            // var data = new FormData(formOnes);
            axios.post("https://sabinelibrary.chukahighschool.sc.ke/api/deleteItem/" + this.item.id).then(response => {

                $("#deleteModal").modal("hide");
                this.items = this.items.filter((item) => item.id !== this.item.id);

                this.$toast.success(`Deleted successfully`, {
                    position: "top",
                    dismissible: false
                })

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
        getsuppliers() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("https://sabinelibrary.chukahighschool.sc.ke/api/getsuppliers").then(response => {
                this.suppliers = response.data.data;

                this.$emitter.emit('changeLoaderStatus', false)
            })

        },

        downloadItem(row) {
            const id = row.id;
            this.id = id;

              const titles =row.file_name;
               this.title = titles;
           // this.id = item.id;
            this.$emitter.emit('changeLoaderStatus', true);

            // Construct the correct URL for the download
            //const url = `http://127.0.0.1:8000/api/downloadItem/${this.id}`;
            const url = "https://sabinelibrary.chukahighschool.sc.ke/api/downloadItem/" + this.id;

            axios.get(url, {
                    responseType: 'blob'
                }) // Specify responseType as 'blob'
                .then(response => {
                    // Handle the file download here
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement("a");
                    link.href = url;
                    link.setAttribute("download", this.title);
                    document.body.appendChild(link);
                    link.click();
                    link.remove();

                    // Hide the modal and show a success message
                    $("#deleteModal").modal("hide");
                    this.$toast.success(`Downloaded successfully`, {
                        position: "top",
                        dismissible: false
                    });
                })
                .catch(error => {
                    if (error.response && (error.response.status === 500 || error.response.status === 400)) {
                        this.$toast.error(`SOMETHING WENT WRONG! CONTACT ADMIN FOR HELP!`, {
                            position: "top"
                        });
                    } else {
                        this.$toast.error(`ServerError! Try again!`, {
                            position: "top"
                        });
                    }
                })
                .finally(() => {
                    this.$emitter.emit('changeLoaderStatus', false);
                });
        },

        downloadFile(item) {
            this.id = item.id;
            axios.get(`https://sabinelibrary.chukahighschool.sc.ke/api/downloadItem/${this.id}`, {
                    responseType: 'arraybuffer'
                })
                .then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', this.filename);
                    document.body.appendChild(link);
                    link.click();

                    // Remove the download link from the body
                    document.body.removeChild(downloadLink);
                    alert('file download ok');
                });
        },

    },

}
</script>

<style>

</style>
