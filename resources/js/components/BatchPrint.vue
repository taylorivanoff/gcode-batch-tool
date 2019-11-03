<template>
  <div>

    <div class="text">
      <h1>G-code batch printing tool</h1>

      <div class="text">
        <a href="https://www.reddit.com/r/3Dprinting/comments/cxd5fl/creating_an_automated_batch_print_farm/">Reddit: Creating an automated batch print farm</a>
        <br>
        <a href="https://github.com/taylorivanoff/gcode-batch-tool">GitHub Repository</a>
      </div>

      <p>Simply, this tool stitches together gcode and repeats it X number of times.</p>
      <p>This is particuraly useful for when you want to 3D print something over and over again.</p>
      <p>The gcode included below is what works for my particular setup, but because everyone's 3D printing setup is different, you will want to customise the gcode below to work for you.</p>
      <strong>Make sure the gcode you upload contains no start or end gcode already.</strong>
    </div>

    <el-form ref="form" :model="form" label-width="120px">

      <el-form-item label="No. of Repeats">
          <el-input-number v-model="form.repeats" :min="1" :max="10"></el-input-number>
      </el-form-item>
      
      <el-form-item label="Start gcode">
        <el-input
          type="textarea"
          :autosize="{ minRows: 4, maxRows: 16}"
          v-model="form.start">
        </el-input>
      </el-form-item>

      <el-form-item label="Leveling gcode">
        <el-input
          type="textarea"
          :autosize="{ minRows: 4, maxRows: 16}"
          v-model="form.leveling">
        </el-input>
      </el-form-item>

      <el-form-item label="Push gcode">
        <el-input
          type="textarea"
          :autosize="{ minRows: 4, maxRows: 16}"
          v-model="form.push">
        </el-input>
      </el-form-item>

      <el-form-item label="End gcode">
        <el-input
          type="textarea"
          :autosize="{ minRows: 4, maxRows: 16}"
          v-model="form.end">
        </el-input>
      </el-form-item>

      <el-form-item>
         <el-upload
          class="upload-demo"
          drag
          action="api/batch/file"
          :file-list="fileList"
          :on-success="onSuccess"
          :limit="1"
          >
          <i class="el-icon-upload"></i>
          <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
          <div class="el-upload__tip" slot="tip">gcode files with a size less than 500kb</div>
        </el-upload>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="onSubmit">Create</el-button>
      </el-form-item>

    </el-form>
  </div>
</template>

<style scoped>
  .text {
    padding: 2rem 0;
  }
</style>

<script>
  export default {
    data() {
      return {
        fileList: [],
        form: {
          file: '',
          repeats: '',
          start: 'M115 U3.7.2 ; tell printer latest fw version\n\
G90 ; use absolute coordinates\n\
M83 ; extruder relative mode\n\
M104 S215 ; set extruder temp\n\
M140 S60 ; set bed temp\n\
                  ',
          leveling: 'G28 W ; home all without mesh bed level\n\
G80 ; mesh bed leveling\n\
M190 S60 ; wait for bed temp\n\
M109 S215 ; wait for extruder temp\n\
G1 Y-3.0 F1000.0 ; go outside print area\n\
G92 E0.0\n\
G1 X60.0 E9.0 F1000.0 ; intro line\n\
G1 X100.0 E12.5 F1000.0 ; intro line\n\
G92 E0.0\n\
M221 S95\n\
          ',
          push: 'M140 S0 ; turn off heatbed\n\
M221 S100\n\
G91 ; relative\n\
G1 Y50.0 F3000.0 ; move bed forward\n\
G90 ; absolute\n\
G1 Z2.0 F4500.0 ; move down to the bed\n\
G4 S45; wait\n\
G1 X250.0 F3000.0 ; push to the right max',
          end: 'G4 ; wait\n\
M221 S100\n\
M104 S0 ; turn off temperature\n\
M140 S0 ; turn off heatbed\n\
M107 ; turn off fan\n\
G91 ; relative\n\
G1 Z40.0 F3000.0 ; move head up\n\
G90 ; absolute\n\
G1 X0 Y200 F3000 ; home X axis\n\
M84 ; disable motors',
        }
      }
    },
    methods: {
      onSuccess(response, file, fileList) {
        this.form.file = response
      },
      onSubmit() {
        axios.post('batch', {
            form: this.form,
        },
        {
          headers: {
            responseType: 'arraybuffer',
            headers: {
              'Accept': 'application/octet-stream',
            },
          }
        })
        .then(response => {
          this.$message({
            message: 'Success',
            type: 'success'
          });

          let blob = new Blob([response.data],{ type:'text/plain'});
          let link = document.createElement('a');
          link.href = window.URL.createObjectURL(blob);
          link.download = 'batch.gcode';
          link.click();
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