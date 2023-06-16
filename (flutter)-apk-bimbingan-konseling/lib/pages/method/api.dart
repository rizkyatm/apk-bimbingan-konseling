import 'dart:convert';
// import 'dart:html';
import 'package:http/http.dart' as http;

class API{
  postRequest({
    // ketentuan
    required String route, 
    required Map<String,String> data,
  }) async {
    final String apiUrl = ' https://dc16-182-0-136-138.ngrok-free.app/api/auth';
    // apiUrl dari atas dan route itu untuk menjalankan perintah yang ada di link apiUrl
    String url = apiUrl + route;
    // postRequest menjalankan http.post(metod), membutuhkan : uri(link line 13), body(isi data yang akan di kirim ke url), headers(buat ngirim datanya/setingan)
    return await http.post(
      Uri.parse(url),
      body: jsonEncode(data), //
      headers: _header(), //
    );
  }

  // static getData(int id, String route) async {
  //   final String apiUrl = 'http://127.0.0.1:8000/api/auth';
  //   String url = apiUrl + route;

  //   http.Response response = await http.get(Uri.parse(url));

  //   var responseBody = jsonDecode(response.body);
  //   return responseBody;
  // }



  _header()=>{
    'Content-type':'application/json', // ada di header (key)
    'Accept': 'application/json', //ada di header (key)
  };
}