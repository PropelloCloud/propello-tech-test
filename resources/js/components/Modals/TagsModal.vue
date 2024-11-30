<template>
  <div v-show="open" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50">
    <div class="fixed inset-0 transform transition-all">
      <div class="absolute inset-0 bg-gray-500 opacity-75" @click="closeModal"></div>
    </div>

    <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg sm:mx-auto">
      <div class="p-6">
        <h2 class="text-xl font-semibold mb-4">Manage Tags for: {{ task?.name }}</h2>

        <!-- Display tags -->
        <ul v-if="tags && tags.length > 0" class="list-disc pl-5">
          <li v-for="tag in tags" :key="tag.id" class="inline-flex items-center mb-2">
            <!-- It is styled so that it will be displayed as a badge with a delete button on it
                    in the form of an X -->
            <span :id="'badge-dismiss-' + tag.id" class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-blue-800 bg-blue-100 rounded max-w-[200px]">
              <span
                    class="overflow-x-auto"
                >
                    {{ tag.name }}
                </span>
              <!-- Delete button -->
              <button
                  type="button"
                  @click="removeTag(tag.id)"
                  class="inline-flex items-center p-1 ms-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200 hover:text-blue-900"
                >
                  <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Remove badge</span>
                </button>
            </span>
          </li>
        </ul>



        <p v-else>No tags associated with this task.</p>

        <!-- Close button -->
        <button @click="closeModal" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 float-right mb-4">Close</button>
      </div>
    </div>
  </div>
   <modal name="feedback" v-show="openFeedbackModal">
       <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">Feedback</h2>
            <p>{{ feedbackMessage }}</p>
            <button
                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 float-right mb-4"
                @click="closeFeedbackModal"
            >
                Close
            </button>
        </div>
   </modal>
</template>

<script>
import CSRF from "../Layout/CSRF.vue";

export default {
  name: "TagsModal",
    components: {CSRF},
  data() {
    return {
      open: false,
      task: null,
      tags: null,
      feedbackMessage: '',
      openFeedbackModal: false

    };
  },
  methods: {
    // Open the modal and pass the task data via the method call
    openModal(task,tags) {
      this.task = task;  // Set the task data inside the modal
      this.tags = tags
      this.open = true;   // Open the modal
    },
    closeModal() {
      this.task = null;
      this.tags = null;
      this.open = false;  // Close the modal
    },
    closeFeedbackModal(){
        this.openFeedbackModal = false;
        this.feedbackMessage = null
    },
    async removeTag(tagId) {
      axios
        .get(`/task/${this.task.id}/tags/delete/${tagId}`)
        .then((response) => {
          this.tags = this.tags.filter((tag) => tag.id !== tagId); // Update tags list
            this.feedbackMessage = response.data.success
            this.closeModal()
            this.openFeedbackModal = true;

        })
        .catch((error) => {
            this.feedbackMessage = error.response.data.error
        });
    },
},
};
</script>

<style scoped>
</style>
