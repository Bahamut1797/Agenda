<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createReminder'}" class="btn btn-success">Create new reminder</router-link>
        </div>
 
        <div class="panel panel-default">
            <div class="panel-heading">Reminder list</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Location</th>
                        <th>Alarm Date</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="reminder, index in reminders">
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
                reminders: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/reminders')
                .then(function (resp) {
                    app.reminders = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load reminders");
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