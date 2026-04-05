<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import Base from "../../../layouts/Admin/Base.vue";
import api from "../../../lib/Api";

const testimonials = ref([]);
const router = useRouter();

const getTestimonials = async () => {
    await api.get("/v1/testimonials").then(({ data }) => {
        testimonials.value = data.testimonials;
        console.log(testimonials.value);
    });
};

const ourImage = (img) => {
    if (img) {
        return "/upload/" + img;
    } else {
        return "/template/assets/img/avatar.jpg";
    }
};

const addTestimonial = () => {
    router.push("/admin/testimonials/create");
};

const editTestimonial = (id) => {
    router.push(`/admin/testimonials/${id}/edit`);
};

onMounted(async () => {
    await getTestimonials();
});

const handleDelete = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able ro revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            api.delete(`/v1/testimonials/${id}`).then(() => {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                });
                getTestimonials();
            });
        }
    });
};
</script>
<template>
    <Base />
    <!--==================== PROJECTS ====================-->
    <section class="testimonials" id="projects">
        <div class="titlebar">
            <h1>Testimonials</h1>
            <button @click="addTestimonial">New Testimonial</button>
        </div>
        <div class="table">
            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li>
                            <p class="table-filter-link link-active">All</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-search">
                <div>
                    <select class="search-select" name="" id="">
                        <option value="">Filter Project</option>
                    </select>
                </div>
                <div class="relative">
                    <input
                        class="search-input"
                        type="text"
                        name="search"
                        placeholder="Search Project..."
                    />
                </div>
            </div>

            <div class="testimonial_table-heading">
                <p>Photo</p>
                <p>name</p>
                <p>Function</p>
                <p>Testimony</p>
                <p>Rating</p>
                <p>Actions</p>
            </div>
            <!-- item 1 -->
            <div
                class="testimonial_table-items"
                v-for="testimonial in testimonials"
                :key="testimonial.id"
            >
                <p>
                    <img
                        :src="ourImage(testimonial.image)"
                        alt=""
                        class="testimonial_img-list"
                    />
                </p>
                <p>{{ testimonial.name }}</p>
                <p>{{ testimonial.function }}</p>
                <p>{{ testimonial.testinomy }}</p>
                <p>{{ testimonial.rating }}</p>
                <div>
                    <button
                        class="btn-icon success"
                        @click="editTestimonial(testimonial.id)"
                    >
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button
                        class="btn-icon danger"
                        @click="handleDelete(testimonial.id)"
                    >
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <div class="table-paginate">
                <div class="pagination">
                    <a href="#" class="btn">&laquo;</a>
                    <a href="#" class="btn active">1</a>
                    <a href="#" class="btn">2</a>
                    <a href="#" class="btn">3</a>
                    <a href="#" class="btn">&raquo;</a>
                </div>
            </div>
        </div>
    </section>
</template>
