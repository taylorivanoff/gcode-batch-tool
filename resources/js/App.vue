<template>
  <div>
    <el-container>
      <el-main>
        
        <el-row>
          <el-col :span="24">
            <div class="grid-content">
              <example-component></example-component>
            </div>
          </el-col>
        </el-row>
        <!-- <el-row>
          <el-col :span="24">
            <div class="grid-content">
              <h1>Search</h1>
              <example-component></example-component>
            </div>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="24">
            <div class="grid-content">
              <h1>New Post</h1>
              <post-form></post-form>
            </div>
          </el-col>
        </el-row> -->


      </el-main>
    </el-container>

  </div>
</template>
<script>
  export default {
    name: 'app',
    data () {
      return {
        activeIndex: '1',
        visible: false,
      }
    },
    methods: {
      handleSelect(key, keyPath) {
        console.log(key, keyPath);
      }
    }
  };
</script>
<style scoped>
  /* Add scoped styles */
  #app {
    padding: 0;
    margin: 0;
  }

  .el-row {
    margin: 4rem 0;
    &:last-child {
      margin-bottom: 0;
    }
  }

  .el-container {
    max-width: 590px;
    margin: auto;
  }
</style>