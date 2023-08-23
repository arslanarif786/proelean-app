export default function nativeShare(title, path = "error") {
  const url = process.env.VUE_APP_LOCAL_URL + path;
  if (navigator.share) {
    navigator
      .share({
        title: title,
        url: url,
      })
      .then(() => {
        console.log("Thanks for sharing!");
      })
      .catch(console.error);
  } else {
      console.log('Share api is not supported on this browser');
  }
}