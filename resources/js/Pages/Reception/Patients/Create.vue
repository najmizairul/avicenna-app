<template>
    <app-layout title="Register a Patient">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Register a Patient
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>

                        <div>
                            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                                <div class="mt-8 text-2xl">
                                   Please provide relevant details
                                </div>

                                <div class="mt-6 text-gray-500">
                                    <form @submit.prevent="register">

                                        <div class="py-3">
                                            <jet-label for="name" value="Full Name" />
                                            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
                                            <div>Hello {{form.name}}</div>
                                        </div>

                                        <div class="py-3">
                                            <jet-label for="email" value="Email" />
                                            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                                        </div>

                                        <div class="py-3">
                                            <jet-label for="ic" value="IC Number" />
                                            <jet-input id="ic" type="number" class="mt-1 block w-full" v-model="form.ic" required />
                                        </div>

                                        <div class="py-3">
                                            <jet-label for="phone" value="Phone number" />
                                            <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required />
                                        </div>


                                        <div class="py-3">
                                            <jet-label for="sex" value="Gender" />
                                            <select id="sex" aria-placeholder="Please select Gender"  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" v-model="form.sex" required>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>


                                        <div class="py-3">
                                            <jet-label for="dob" value="Date Of Birth" />
                                            <jet-input id="dob" type="date" class="mt-1 block w-full" v-model="form.dob" required />
                                        </div>

                                        <div class="py-3">
                                            <jet-label for="address" value="Address" />
                                            <textarea rows="7" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="address" v-model="form.address"></textarea>
                                        </div>



                                        <div class="py-3">
                                            <jet-button class="ml-4" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Submit
                                            </jet-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import Button from "@/Jetstream/Button.vue";
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
export default defineComponent({
    components: {
        Button,
        AppLayout,
        JetLabel,
        JetInput,
        JetButton

    },

    data() {
        return {
            form: this.$inertia.form({
                name: null,
                email: null,
                address: null,
                ic: null,
                phone: null,
                dob: null,
                sex: null
            })
        }
    },


    methods: {
        register() {
            this.form.post(this.route('reception.patients.register'),  {
                onFinish: () => this.form.reset('form'),
            });
        }
    }

    //props: ['patient']
})
</script>
