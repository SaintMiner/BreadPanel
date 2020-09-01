export default {
    data() {
        return {
            rules: {
                required: value => !!value || 'Required.',
                counter: value => !!value ? value.length <= 255 || 'Max 255 characters' : true,                
            }
        }
    }
  };