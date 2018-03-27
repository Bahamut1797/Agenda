<template>
    <div>
        <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Delete Reminder</h4>
                    </div>
                    <div class="modal-body">
                        <span>Do you really want to delete <b>"{{ reminderTitle }}"</b> reminder?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <span class="pull-right">
                            <button type="button" class="btn btn-danger" v-on:click="deleteEntry()">
                                Continue
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <router-link :to="{name: 'createReminder'}" class="btn btn-success">Create new reminder</router-link>
        </div>
 
        <div class="panel panel-default">
            <div class="panel-heading">Reminder list</div>
            <div class="panel-body">
                <div v-if="loading">
                    <img src="/imgs/loader.gif"/>
                    Loading.....
                </div>
                <table v-if="!loading" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="col-xs-3">Title</th>
                        <th class="col-xs-1">Amount</th>
                        <th class="col-xs-4">Location</th>
                        <th class="col-xs-3">Alarm Date</th>
                        <th class="col-xs-1">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(reminder, index) in reminders" :key="reminder.id">
                        <td>{{ reminder.title }}</td>
                        <td>{{ reminder.amount }}</td>
                        <td><a target="_blank" v-bind:href="reminder.urlLoc">{{ reminder.location }}</a></td>
                        <td>{{ reminder.alarmDate }} - {{ reminder.alarmTime }}</td>
                        <td>
                            <router-link :to="{name: 'editReminder', params: {id: reminder.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModalDelete"
                               v-on:click="setValues(reminder.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {
                reminders: [],
                loading: false,
                reminderTitle: '',
                reminderId: 0,
                reminderIndex: ''
            }
        },
        mounted() {
            var app = this;
            app.loading = true;
            axios.get('/api/v1/reminders')
                .then(function (resp) {
                    app.loading = false;
                    app.reminders = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    $.notify("Could not load reminders", "error");
                    app.loading = false;
                });
        },
        methods: {
            setValues(id, index) {
                var app = this;
                app.reminderId = id;
                app.reminderIndex = index;
                app.reminderTitle = app.reminders[index].title;
            },
            deleteEntry() {
                var app = this;
                axios.delete('/api/v1/reminders/' + app.reminderId)
                    .then(function (resp) {
                        $.notify("Reminder deleted", "success");
                        app.reminders.splice(app.reminderIndex, 1);
                        $('#myModalDelete').modal('hide');
                    })
                    .catch(function (resp) {
                        $.notify("Could not delete reminder", "error");
                        $('#myModalDelete').modal('hide');
                    });
            }
        }
    }
</script>