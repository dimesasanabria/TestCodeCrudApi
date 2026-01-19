<template> 
    <div>
        <h2>CRUD API</h2>
        <!--Create-->
          <input v-model="form.UDDI" placeholder="UDDI">
          <input v-model="form.name" placeholder="name">
          <input v-model="form.description" placeholder="description">
          <input v-model="form.code" placeholder="code">
          <p>
              <!-- Field label -->
        <!-- Switch -->
            <input class="form-check-input" type="checkbox" id="statusSwitch" v-model="form.status" :true-value="'active'" :false-value="'inactive'">
            <label class="form-check-label" for="statusSwitch">
              {{ form.status === 'active' ? 'Active' : 'Inactive' }}
            </label>
            </p>
            <button @click="createPost">Save</button>
          
    <!-- List -->
    <ul>
      <li v-for="post in posts" :key="post.id" class="bg-white rounded-lg shadow-md p-4 hover:shadow-xl transition">
        <h2 class="text-xl font-semibold mb-2">UDDI: {{ post.UDDI }}</h2>
        <p class="text-gray-700 mb-4">Name: {{ post.name }}</p>
        <p class="text-gray-700 mb-4">Description: {{ post.description }}</p>
        <p class="text-gray-700 mb-4">code: {{ post.code }}</p>
        <p class="text-gray-700 mb-4">Status: {{ post.status }}</p>
           <!-- scroll active -->
        <button @click="editPost(post)"class="btn btn-primary me-2">Edit</button>
        <button @click="deletePost(post.id)"class="btn btn-danger">Delete</button>
      </li>
    </ul>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      posts: [],
      form: {
        id: null,
        title: '',
        content: ''
      }
    }
  },
  mounted() {
    this.fetchPosts();
  },
  methods: {
    fetchPosts() {
      axios.get('/api/posts')
        .then(res => this.posts = res.data);
    },

    createPost() {
      axios.post('/api/posts', this.form)
        .then(() => {
          this.fetchPosts();
          this.form.title = '';
          this.form.content = '';
        });
    },

    editPost(post) {
      this.form = { ...post };
      // 🔽 scroll to top / form
      window.scrollTo({ top: 0, behavior: 'smooth' })
    },

    updatePost() {
      axios.put(`/api/posts/${this.form.id}`, this.form)
        .then(() => this.fetchPosts());
    },

    deletePost(id) {
      axios.delete(`/api/posts/${id}`)
        .then(() => this.fetchPosts());
    }
  }
}
</script>
