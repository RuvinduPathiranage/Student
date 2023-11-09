<script>
import { computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/App.vue'
import { Link } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
import axios from 'axios';


export default {
    components: {
        AppLayout,
        Link,
        TextInput
    },
    // props: {
    //     students: Array
    // },
    data() {
        return {
            form: {
                name: null,
                age: null,
                images: null,
            },
            student_update_form: {
                name: null,
                age: null,
            },
            student_list: [],
        }
    },
    beforeMount() {
        this.getstudent();
    },
    methods: {
        async getstudent() {
            this.student_list = (await axios.get(route('student.list'))).data
        },

        submit() {
            router.post('/student/store', this.form)
            // await axios.post(route('student.store'), this.form).data;
            this.form.name = '';
            this.form.age = '';
            this.form.images = '';

            this.getstudent();
        },
        async deletestudent(id) {
            // students = router.post('/student/store', this.form)
            await axios.get(route('student.delete', id));
            this.getstudent();
        },
        async studentStatus(id) {
            await axios.get(route('student.status', id));
            this.getstudent();
        },
        async StudentUpdated() {
            // router.post('/student/update', this.form)
            await axios.post(route('student.update', this.student_update_form.id), this.student_update_form);
            this.getstudent();
        },
        async studentEdit(id) {
            const student = (await axios.get(route('student.edit', id))).data;
            this.student_update_form = student;
        },
        getLogo(imgname) {
            return 'http://127.0.0.1:8000/uploads/' + imgname;
        },

    },
}
</script>

<template>
    <AppLayout>
        <template #content>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mt-4 text-center">
                        <h1 class="text-success">Student List</h1>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <form @submit.prevent="submit" enctype="multipart/form-data">
                                <div class="input-group mb-3 col-12">
                                    <input type="text" class="form-control col-6" placeholder="Name" v-model="form.name"
                                        id="name" name="name" />
                                    <input type="text" class="form-control col-6" placeholder="age" v-model="form.age"
                                        id="age" name="age" />
                                </div>
                                <div class="input-group mb-1">
                                    <input type="file" class="dropify col-4" placeholder="" name="images"
                                        @input="form.images = $event.target.files[0]" accept="image/jpg, image/png" />
                                </div>
                                <button class="btn btn-success mt-2 col-12" type="submit" id="">Button</button>
                            </form>
                        </div>

                    </div>

                </div>
                <div class="col-lg-12 mt-5">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(student, key) in student_list">
                                <th scope="row">{{ ++key }}</th>
                                <td>{{ student.name }}</td>
                                <td>{{ student.age }}</td>
                                <!-- <td>{{ student.images }}</td> -->
                                <td><img :src="getLogo(student.image)" alt="" class="imagetag"></td>
                                <td>
                                    <span v-if="student.status == 0" class="badge bg-danger">inactive</span>
                                    <span v-else class="badge bg-success">active</span>
                                </td>
                                <td>
                                    <button @click.prevent="deletestudent(student.id)" type="button"
                                        class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg></button>
                                    <button @click.prevent="studentStatus(student.id)" class="btn btn-success"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-check-square-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                        </svg></button>
                                    <button @click.prevent="studentEdit(student.id)" data-bs-toggle="modal"
                                        data-bs-target="#studentedit" class="btn btn-warning"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </template>
        <template #models>
            <div class="modal fade" id="studentedit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="studenteditLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="studenteditLabel">Students Update</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="">
                            <form @submit.prevent="StudentUpdated">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input class="form-control" name="name" v-model="student_update_form.name"
                                                type="text" placeholder="Enter the text" required />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input class="form-control" name="name" v-model="student_update_form.age"
                                                type="text" placeholder="Enter the text" required />
                                        </div>
                                    </div>

                                    <div class="co-12 mt-3">
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-dark col-12 font-weight-bold" data-bs-dismiss="modal" aria-label="Close">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>


<style>
.imagetag {
    width: 50px;
    height: 50px;
}
</style>