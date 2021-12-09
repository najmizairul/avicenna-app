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
                                        <h5>Pantai Hospital Batu Pahat -  Doctors App</h5>
                                    </div>
                                    <div class="div">
                                        <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">View Orders</a>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class=" sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-3">
                                        <div id="jh-stats-positive" class="flex flex-col justify-center px-4 py-4 bg-white border border-gray-300 rounded">
                                            <div>
                                                <!--                                        <div>-->
                                                <!--                                            <p class="flex items-center justify-end text-green-500 text-md">-->
                                                <!--                                                <span class="font-bold">6%</span>-->
                                                <!--                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M20 15a1 1 0 002 0V7a1 1 0 00-1-1h-8a1 1 0 000 2h5.59L13 13.59l-3.3-3.3a1 1 0 00-1.4 0l-6 6a1 1 0 001.4 1.42L9 12.4l3.3 3.3a1 1 0 001.4 0L20 9.4V15z"/></svg>-->
                                                <!--                                            </p>-->
                                                <!--                                        </div>-->
                                                <p class="text-3xl font-semibold text-center text-gray-800"> {{ patientsWaiting }}</p>
                                                <p class="text-lg text-center text-gray-500">Patients Waiting</p>
                                            </div>
                                        </div>

                                        <div id="jh-stats-negative" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                                            <div>

                                                <p class="text-3xl font-semibold text-center text-gray-800">{{ patientsToday }}</p>
                                                <p class="text-lg text-center text-gray-500">Patients Today</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="flex py-2">
                                    <div class="block w-full overflow-x-auto">
                                        <table class="items-center bg-transparent w-full border-collapse ">
                                            <thead>
                                            <tr>
                                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                    SN
                                                </th>
                                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                    Full Name
                                                </th>
                                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                    IC Number
                                                </th>
                                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                    Referrer
                                                </th>
                                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                    Last Visit
                                                </th>
                                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr v-for="(patient, key) in patients" :key="key">
                                                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                                    {{ key + 1 }}
                                                </th>
                                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                                                    {{ patient.name }}
                                                </td>

                                                <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                    {{ patient.ic }}
                                                </td>
                                                <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                    {{ patient.referrer }}
                                                </td>

                                                <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                    {{ patient.last_visited_at }}
                                                </td>

                                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                    <Link :href="route('doctors.patients.show', { code: patient.rn })">See Patient</Link>
                                                </td>
                                            </tr>

                                            </tbody>

                                        </table>
                                    </div>
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
    import {Link} from "@inertiajs/inertia-vue3";

    export default defineComponent({
        props: ['stats', 'patients'],
        components: {
            Button,
            Link,
            AppLayout,
        },

        computed: {
            patientsWaiting() {
                return this.stats.patientsWaiting;
            },

            patientsToday() {
                return  this.stats.patientsToday;
            }
        }
    })
</script>
