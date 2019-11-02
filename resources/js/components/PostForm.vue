<template>
	<el-form ref="form" :model="form" label-width="120px">
	  <el-form-item label="Name">
	    <el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item label="Description">
	    <el-input type="textarea" v-model="form.desc"></el-input>
	  </el-form-item>
	  <el-form-item>
	    <el-button type="primary" @click="onSubmit">Create</el-button>
	  </el-form-item>
	</el-form>
</template>
<script>
	export default {
    data() {
      return {
        form: {
          name: '',
          desc: ''
        }
      }
    },
    methods: {
      onSubmit() {
        axios.post('posts', {
            name: this.form.name,
            desc: this.form.desc
        })
        .then(response => {
        	this.$message({
            message: 'Post saved.',
            type: 'success'
          });

          this.form = {}
        })
        .catch(error => {
            if (error.response) {
            	console.error(error.response.data)
            }
        })
      }
    }
  }
</script>