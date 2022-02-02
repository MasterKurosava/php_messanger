function debounce(func, wait) {
    let timepoutId;

    return function(...args){
        if(timepoutId){
            clearTimeout(timepoutId);
        }
        timepoutId=setTimeout(()=>{
            func(...args);
        },wait)
    }
  };

export default debounce;