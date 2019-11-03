<template>
  <div>
    <el-container>
      <el-main>
        <el-row>
          <el-col :span="24">
            <div class="grid-content">
              <batch-print></batch-print>
            </div>
          </el-col>
        </el-row>
      </el-main>
    </el-container>
  </div>
</template>
<script>
  export default {
    name: 'app'
  };
</script>
<style scoped>
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