<template>
    <div>
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
                        <td>{{ reminder.location }}</td>
                        <td>{{ reminder.alarmDate }} - {{ reminder.alarmTime }}</td>
                        <td>
                            <router-link :to="{name: 'editReminder', params: {id: reminder.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(reminder.id, index)">
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
                loading: false
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
                    alert("Could not load reminders");
                    app.loading = false;
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/v1/reminders/' + id)
                        .then(function (resp) {
                            app.reminders.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete reminder");
                        });
                }
            }
        }
    }
</script>