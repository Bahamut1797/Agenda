<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>
 
        <div class="panel panel-default">
            <div class="panel-heading">Create new reminder</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Reminder title</label>
                            <input type="text" v-model="reminder.title" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Is a Payment?</label>
                            <input type="checkbox" v-model="reminder.isPayment" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Reminder amount</label>
                            <input type="number" v-model="reminder.amount" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Location</label>
                            <input type="text" v-model="reminder.location" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Frecuency</label>
                            <input type="text" v-model="reminder.frecuency" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Repeat</label>
                            <input type="checkbox" v-model="reminder.repeat" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Alarm Date</label>
                            <input type="date" v-model="reminder.alarmDate" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Alarm Time</label>
                            <input type="time" v-model="reminder.alarmTime" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Delete it when finished?</label>
                            <input type="checkbox" v-model="reminder.deleteIt" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {
                reminder: {
                    title: '',
                    isPayment: false,
                    amount: null,
                    location: null,
                    frecuency: '',
                    repeat: false,
                    alarmDate: null,
                    alarmTime: '',
                    deleteIt: false,
                }
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newReminder = app.reminder;
                axios.post('/api/v1/reminders', newReminder)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your reminder");
                    });
            }
        }
    }
</script>
 