export default function MediaService(){
    function getMediaUrl(path){
        return "https://api.dex.proelean.com/"+path
    }
    return { getMediaUrl }
}