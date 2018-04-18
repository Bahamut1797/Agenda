<template>
    <div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" >
                <form v-on:submit.prevent="saveCategory()">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Add new category</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 form-group">
                                    <label class="control-label" >Would you like to add a new category?</label>
                                    <input type="text" style="width:50%; display:unset;" required v-model="category.name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <span class="pull-right">
                                <button type="submit" class="btn btn-primary">
                                    Add Category
                                </button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="form-group">
            <button @click="$router.go(-1)" class="btn btn-default">Back</button>
        </div>
 
        <div class="panel panel-default">
            <div class="panel-heading">Edit reminder</div>
            <div class="panel-body">
                <form v-on:submit.prevent="saveForm()">
                    <div class="row">
                        <div class="col-xs-7 form-group">
                            <label id="myElement" class="control-label">Reminder title</label>
                            <input type="text" required v-model="reminder.title" class="form-control">
                        </div>
                        <div class="col-xs-5 form-group">
                            <label class="control-label" style="display:block;" >Category</label>
                            <select v-model="reminder.category" class="form-control" style="width:70%; display:unset;" >
                                <option v-for="category in categories" v-bind:value="category.id" :key="category.id" >
                                    {{ category.name }}
                                </option>
                            </select>
                            <button class="btn btn-default" style="border:none; padding:6px 4px;" v-on:click.prevent=";" data-toggle="modal" data-target="#myModal" >
                                <img src="/open-iconic/svg/plus.svg" width="15" alt="add category" />
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Description</label>
                            <textarea id="description" class="form-control" maxlength='1000' rows='4' placeholder="A brief description" v-model="reminder.description"></textarea>
                            <span id="counter" class="control-label">0 / 1000</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            <label class="control-label">Is a Payment?</label>
                            <input type="checkbox" v-model="reminder.isPayment">
                        </div>
                        <div v-if="reminder.isPayment == 1" class="col-xs-8 form-group">
                            <label class="control-label">Amount</label>
                            <input type="number" v-bind:required="reminder.isPayment == 1 ? true : false"  min="0" step=".01" v-model="reminder.amount" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Location</label>
                            <gmap-autocomplete id="map" class="form-control"></gmap-autocomplete>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label class="control-label">Contact Number</label>
                            <input type="tel" v-model="reminder.contact" class="form-control" placeholder="+525512345678">
                        </div>
                        <div class="col-xs-6 form-group">
                            <label class="control-label">CC (Email)</label>
                            <input type="email" v-model="reminder.secEmail" class="form-control" placeholder="example@domain.com">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label class="control-label">Alarm Date</label>
                            <input id="date" type="date" v-model="reminder.alarmDate" class="form-control">
                        </div>
                        <div class="col-xs-6 form-group">
                            <label class="control-label">Alarm Time</label>
                            <input type="time" required v-model="reminder.alarmTime" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label class="control-label">Frecuency</label>
                            <select v-model="reminder.frecuency" class="form-control">
                                <option v-for="frec in frecEnum" v-bind:value="frec" :key="frec">
                                    {{ frec }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Archive it when finished?</label>
                            <input type="checkbox" v-model="reminder.archiveIt">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            $(document).ready(function() {
                $(window).keydown(function(event){
                    if(event.keyCode == 13 && document.activeElement.id != 'description') {
                        event.preventDefault();
                        return false;
                    }
                });
            });

            var textarea = document.querySelector("textarea");

            textarea.addEventListener("input", function(){
                var maxlength = this.getAttribute("maxlength");
                var currentLength = this.value.length;

                $('#counter').text(currentLength + " / " + maxlength);
            });

            var d = new Date();
            var currentDate = d.getFullYear().toString() + "-" + ((d.getMonth()+1 < 10) ? ("0" + (d.getMonth()+1)) : (d.getMonth()+1)) + "-" + ((d.getDate() < 10) ? ("0" + d.getDate()) : d.getDate());

            let app = this;

            app.reminder.alarmDate = currentDate;
            $( "#date" ).attr( "min", currentDate );

            let id = app.$route.params.id;
            app.reminderId = id;
            axios.get('/api/v1/reminders/' + id)
                .then(function (resp) {
                    app.reminder = resp.data;
                    document.getElementById("map").value = app.reminder.location;
                    if (app.reminder.description){
                        $('#counter').text(app.reminder.description.length + " / " + textarea.getAttribute("maxlength"));
                    }
                })
                .catch(function () {
                    $.notify("Could not load your reminder", "error");
                });

            axios.get('/api/v1/categories')
                .then(function (resp) {
                    app.categories = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    $.notify("Could not load categories", "warn");
                    $.notify("Refresh the current page", "info");
                });

            // Secret reminder
            var timeoutId = 0;

            $('#myElement').on('mousedown', function() {
                timeoutId = setTimeout(switchSecret, 3000);
            }).on('mouseup mouseleave', function() {
                clearTimeout(timeoutId);
            });

            function switchSecret() {
                if (app.reminder.isSecret == false) {
                    app.reminder.isSecret = true;
                    $.notify("Understood", "success");
                } else {
                    app.reminder.isSecret = false;
                    $.notify("Rollback!", "info");
                }
            }
            // END
        },
        data: function () {
            return {
                reminderId: null,
                reminder: {
                    userId: '',
                    email: '',
                    title: '',
                    category: 1,
                    description: null,
                    isPayment: false,
                    amount: null,
                    location: null,
                    urlLoc: null,
                    contact: null,
                    frecuency: '',
                    custom: null,
                    alarmDate: null,
                    alarmTime: '',
                    secEmail: null,
                    archiveIt: true,
                    isSecret: false,
                },
                category: {
                    userId: '',
                    name: ''
                },
                categories: [],
                frecEnum: ['Once', 'Daily', 'Weekly', 'Montly', 'Custom']
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newReminder = app.reminder;

                app.reminder.location = document.getElementById("map").value;

                if (!newReminder.isPayment) {
                    newReminder.amount=null;
                }

                if(newReminder.location != "") {
                    newReminder.urlLoc = 'https://www.google.com/maps/search/?api=1&query=' + encodeURI(newReminder.location);
                }
                
                axios.patch('/api/v1/reminders/' + app.reminderId, newReminder)
                    .then(function (resp) {
                        $.notify("Reminder updated", "success");
                        app.$router.go(-1);
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        $.notify("Could not update your reminder", "error");
                    });
            },
            saveCategory() {
                var app = this;
                var newCategory = app.category;
                axios.post('/api/v1/categories', newCategory)
                    .then(function (resp) {
                        app.category.name='';
                        $.notify("Category created", "success");
                        $('#myModal').modal('hide');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        $.notify("Could not create your category", "error");
                        app.category.name='';
                        $('#myModal').modal('hide');
                    });
                
                axios.get('/api/v1/categories')
                    .then(function (resp) {
                        app.categories = resp.data;
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        $.notify("Could not load categories", "warn");
                        $.notify("Refresh the current page", "info");
                    });
            }
        }
    }
</script>
 