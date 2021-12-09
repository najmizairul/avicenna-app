<template>
    <app-layout title="Patients">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Patient - {{ patient.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex justify-between">
                    <div  class="p-4 w-2/5">
                        <table class="items-center bg-transparent w-full border-collapse shadow">
                            <tbody>
                            <tr>
                                <th class="border-t-1 px-6 border-l-0 border-r-0 text-md whitespace-nowrap p-4">Full Name:</th>
                                <td class="border-t-0 px-6 border-l-0 border-r-0 text-md whitespace-nowrap p-4">{{ patient.name }}</td>
                            </tr>

                            <tr>
                                <th class="border-t-1 px-6 border-l-0 border-r-0 text-md whitespace-nowrap p-4">Email:</th>
                                <td class="border-t-0 px-6 border-l-0 border-r-0 text-md whitespace-nowrap p-4">{{ patient.email }}</td>
                            </tr>

                            <tr>
                                <th class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">IC Number:</th>
                                <td class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">{{ patient.ic }}</td>
                            </tr>

                            <tr>
                                <th class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">Registered Number:</th>
                                <td class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">{{ patient.rn }}</td>
                            </tr>

                            <tr>
                                <th class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">Phone:</th>
                                <td class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">{{ patient.phone }}</td>
                            </tr>

                            <tr>
                                <th class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">Address:</th>
                                <td class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">{{ patient.address }}</td>
                            </tr>

                            <tr>
                                <th class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">Gender:</th>
                                <td class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">{{ patient.sex }}</td>
                            </tr>

                            <tr>
                                <th class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">Date of Birth:</th>
                                <td class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">{{ patient.dob }}</td>
                            </tr>

                            <tr>
                                <th class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">Last Visit:</th>
                                <td class="border-t-0 px-6  border-l-0 border-r-0 text-md whitespace-nowrap p-4">{{ patient.last_visited_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class=" p-4 w-2/5">
                        <form @submit.prevent="assignDoctor">


                            <div class="py-3">
                                <jet-label for="doctor" value="Select Doctor" />
                                <select id="doctor" aria-placeholder="Please select Doctor"  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" v-model="form.doctor" required>
                                    <option v-for="(doctor, key) in doctors" :key="key" :value="doctor.id">{{ doctor.name }} ({{ doctor.department }})</option>
                                </select>
                            </div>

                            <div class="py-3">
                                <jet-label for="notes" value="Patient Complaint Notes" />
                                <textarea id="notes" rows="5" v-model="form.notes" required  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"></textarea>
                            </div>

                            <div class="py-3">
                                <button class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit">Assign to Doctor</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import JetInput from "@/Jetstream/Input.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetLabel from "@/Jetstream/Label.vue";

export default defineComponent({
    components: {
        JetInput,
        JetLabel,
        JetButton,
        AppLayout,
    },

    props: ['patient', 'doctors'],

    data() {
        return {
            form: this.$inertia.form({
                doctor: null,
                notes: null,
                patient_id: this.patient.id
            })
        }
    },


    methods: {
        assignDoctor() {
            this.form.post(this.route('reception.patients.assignDoctor'),  {
                onFinish: () => this.form.reset('form'),
            });
        }
    }
})
</script>
