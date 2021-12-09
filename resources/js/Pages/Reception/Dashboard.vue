<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                            <div class="mt-8 text-2xl">
                                Welcome {{ $page.props.user.name ?? null }}!
                            </div>

                            <div class="mt-6 text-gray-500">
                                <div class="flex justify-between items-center">
                                    <div class="div">
                                        <h5>Pantai Hospital Batu Pahat -  Reception</h5>
                                    </div>
                                    <div class="div">
                                        <Link :href="route('reception.patients.register')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Register Patient</Link>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- component -->
                        <!-- This is an example component -->
                        <div id="wrapper" class="p-6 sm:px-20 flex justify-between">
                            <div class="w-1/2 sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-3">
                                <div id="jh-stats-positive" class="flex flex-col justify-center px-4 py-4 bg-white border border-gray-300 rounded">
                                    <div>
<!--                                        <div>-->
<!--                                            <p class="flex items-center justify-end text-green-500 text-md">-->
<!--                                                <span class="font-bold">6%</span>-->
<!--                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M20 15a1 1 0 002 0V7a1 1 0 00-1-1h-8a1 1 0 000 2h5.59L13 13.59l-3.3-3.3a1 1 0 00-1.4 0l-6 6a1 1 0 001.4 1.42L9 12.4l3.3 3.3a1 1 0 001.4 0L20 9.4V15z"/></svg>-->
<!--                                            </p>-->
<!--                                        </div>-->
                                        <p class="text-3xl font-semibold text-center text-gray-800"> {{ doctorsAvailable }}</p>
                                        <p class="text-lg text-center text-gray-500">Doctors Available</p>
                                    </div>
                                </div>

                                <div id="jh-stats-negative" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                                    <div>
<!--                                        <div>-->
<!--                                            <p class="flex items-center justify-end text-red-500 text-md">-->
<!--                                                <span class="font-bold">6%</span>-->
<!--                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M20 9a1 1 0 012 0v8a1 1 0 01-1 1h-8a1 1 0 010-2h5.59L13 10.41l-3.3 3.3a1 1 0 01-1.4 0l-6-6a1 1 0 011.4-1.42L9 11.6l3.3-3.3a1 1 0 011.4 0l6.3 6.3V9z"/></svg>-->
<!--                                            </p>-->
<!--                                        </div>-->
                                        <p class="text-3xl font-semibold text-center text-gray-800">{{ patientsToday }}</p>
                                        <p class="text-lg text-center text-gray-500">Patients Today</p>
                                    </div>
                                </div>
                            </div>

                            <div id="jh-stats-neutral" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                                <form class="flex justify-between items-end flex-shrink-0" @submit.prevent="search">
                                    <div>
                                        <jet-label for="search" value="Search by Patient ID" />
                                        <jet-input id="search" type="text" class="mt-1 block w-full" v-model="form.search" required autofocus />
                                    </div>

                                    <div>
                                        <jet-button class="ml-4" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Search
                                        </jet-button>
                                    </div>
                                </form>
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
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Button from "@/Jetstream/Button.vue";
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import {Link } from "@inertiajs/inertia-vue3";

    export default defineComponent({
        components: {
            Button,
            JetButton,
            JetLabel,
            JetInput,
            AppLayout,
            Link
        },

        props: ['stats'],

        data() {
            return {
                form: this.$inertia.form({
                    search: ''
                })
            }
        },

        computed: {
            patientsToday() {
                return this.stats.patientsToday;
            },

            doctorsAvailable() {
                return this.stats.doctorsAvailable;
            }
        },

        methods: {
            search() {
                this.form.post(this.route('reception.patients.search'), {
                    onFinish: () => this.form.reset('search'),
                })
            }
        }
    })
</script>
