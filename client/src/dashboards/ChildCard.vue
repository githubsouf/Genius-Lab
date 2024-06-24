<template>
  <transition name="fade">
    <div v-if="visible" class="child-card"  @click="openWorkshopModal">
      <div class="child-info">
        <h2>{{ child.nom }} {{ child.prenom }}</h2>
        <p>Gender: {{ child.genre || 'N/A' }}</p>
      </div>
      <img src="../assets/images/child%20images/blank-profile-picture-973460_640.webp" alt="Child Image" class="child-image" />

      <button @click="handleDeleteChild" class="btn-delete text-orange-700 mt-5">
        <box-icon type='solid' name='x-circle'></box-icon>
      </button>
      <button @click="openUpdateModal" class="btn-update">
        <box-icon name='pencil'></box-icon>
      </button>
     
    </div>
  </transition>
</template>

<script>
export default {
  props: {
    child: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      visible: true
    };
  },
  computed: {
    imageURL() {
      // Assuming the photo URL is a full URL, otherwise adjust accordingly
      return this.child.photo;
    }
  },
  methods: {
    handleDeleteChild() {
      this.visible = false;
      setTimeout(() => {
        this.$emit('delete-child', this.child.id);
      }, 500); // Timeout duration should match the transition duration
    },
    openUpdateModal() {
      this.$emit('update-child', this.child);
    },
    openWorkshopModal() {
      this.$emit('open-workshop-modal', this.child.id);
    }
  }
}
</script>

<style scoped>
.child-card {
  border: 1px solid #ddd;
  border-radius: 30px;
  padding: 32px;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 32px;
  background-color: #f3f4f6;
  text-align: center;
  width: 200px;
  flex: 0 0 auto;
  position: relative;
}

.child-image {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin-top: 16px;
}

.child-info {
  margin-bottom: 16px;
}

.btn-workshop {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
}

/* Uncomment if you want to use these styles
.btn-delete, .btn-update {
  background: none;
  border: none;
  cursor: pointer;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
*/
</style>