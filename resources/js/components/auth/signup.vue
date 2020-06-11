<template>
  <div id="signup">
    <div class="signup-form">
      <form @submit.prevent="onSubmit">
        <div class="input">
          <label for="email">Mail</label>
          <input
                  type="email"
                  id="email"
                  v-model="user.email">
        </div>
        <div class="input">
          <label for="name">Name</label>
          <input
                  type="name"
                  id="name"
                  v-model="user.name">
        </div>
        <div class="input">
          <label for="age">Your Age</label>
          <input
                  type="number"
                  id="age"
                  v-model.number="user.age">
        </div>
        <div class="input">
          <label for="password">Password</label>
          <input
                  type="password"
                  id="password"
                  v-model="user.password" autocomplete="off">
        </div>
        <div class="input">
          <label for="confirm-password">Confirm Password</label>
          <input
                  type="password"
                  id="confirm-password"
                  v-model="user.confirmPassword" autocomplete="off">
        </div>
        <div class="input">
          <label for="country">Country</label>
          <select id="country" v-model="user.country">
            <option value="usa">USA</option>
            <option value="india">India</option>
            <option value="uk">UK</option>
            <option value="germany">Germany</option>
          </select>
        </div>
        <div class="hobbies">
          <h3>Add some Hobbies</h3>
          <button @click="onAddHobby" type="button">Add Hobby</button>
          <div class="hobby-list">
            <div
                    class="input"
                    v-for="(hobbyInput, index) in user.hobbyInputs"
                    :key="hobbyInput.id">
              <label :for="hobbyInput.id">Hobby #{{ index }}</label>
              <input
                      type="text"
                      :id="hobbyInput.id"
                      v-model="hobbyInput.value">
              <button @click="onDeleteHobby(hobbyInput.id)" type="button">X</button>
            </div>
          </div>
        </div>
        <div class="input inline">
          <input type="checkbox" id="terms" v-model="user.terms">
          <label for="terms">Accept Terms of Use</label>
        </div>
        <div class="submit">
          <button type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  export default {
    data () {
      return {
        user : {
          email: '',
          name: '',
          age: null,
          password: '',
          confirmPassword: '',
          country: 'usa',
          hobbyInputs: [],
          terms: false
        },
      }
    },
    methods: {
      onAddHobby () {
        const newHobby = {
          id: Math.random() * Math.random() * 1000,
          value: ''
        }
        this.user.hobbyInputs.push(newHobby)
      },
      onDeleteHobby (id) {
        this.user.hobbyInputs = this.user.hobbyInputs.filter(hobby => hobby.id !== id)
      },
      onSubmit () {
        this.$swal({
            title: 'Apakah Anda Yakin?',
            icon: 'question',
            text: 'Data data Akan disimpan.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            showCloseButton: true,
            showLoaderOnConfirm: true,
            allowOutsideClick: () => this.$swal.isLoading(),
            preConfirm: () => {
              return axios.post('/signup',this.user)
                          .then(res => {
                            return res;
                          })
                          .catch(error => {
                            return error;
                          })
            },
        }).then((result) => {
          if(result.isConfirmed){
            if (result.value===true) {
              this.$swal('Sukses', 'Data telah disimpan di database', 'success');
              this.onReset()
            }
            else{
              this.$swal('Sukses', result.value.response.data.results.message, 'error');
            }
          }
          else{
            this.$swal('Sukses', 'Data belum disimpan di database', 'error');
          }
        })
      },
      onReset(){
          this.email= '';
          this.name= '';
          this.age= null;
          this.password= '';
          this.confirmPassword= '';
          this.country= 'usa';
          this.hobbyInputs= [];
          this.terms= false;
      }
    }
  }
</script>

<style scoped>
  .signup-form {
    width: 400px;
    margin: 30px auto;
    border: 1px solid #eee;
    padding: 20px;
    box-shadow: 0 2px 3px #ccc;
  }

  .input {
    margin: 10px auto;
  }

  .input label {
    display: block;
    color: #4e4e4e;
    margin-bottom: 6px;
  }

  .input.inline label {
    display: inline;
  }

  .input input {
    font: inherit;
    width: 100%;
    padding: 6px 12px;
    box-sizing: border-box;
    border: 1px solid #ccc;
  }

  .input.inline input {
    width: auto;
  }

  .input input:focus {
    outline: none;
    border: 1px solid #521751;
    background-color: #eee;
  }

  .input select {
    border: 1px solid #ccc;
    font: inherit;
  }

  .hobbies button {
    border: 1px solid #521751;
    background: #521751;
    color: white;
    padding: 6px;
    font: inherit;
    cursor: pointer;
  }

  .hobbies button:hover,
  .hobbies button:active {
    background-color: #8d4288;
  }

  .hobbies input {
    width: 90%;
  }

  .submit button {
    border: 1px solid #521751;
    color: #521751;
    padding: 10px 20px;
    font: inherit;
    cursor: pointer;
  }

  .submit button:hover,
  .submit button:active {
    background-color: #521751;
    color: white;
  }

  .submit button[disabled],
  .submit button[disabled]:hover,
  .submit button[disabled]:active {
    border: 1px solid #ccc;
    background-color: transparent;
    color: #ccc;
    cursor: not-allowed;
  }
</style>