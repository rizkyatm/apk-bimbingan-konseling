import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:myapp/pages/detai-pertemuan.dart';
import 'package:myapp/pages/jadwal-pertemuan.dart';
import 'package:myapp/pages/profile.dart';
import 'package:myapp/pages/login.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class ListPage extends StatefulWidget {
  @override
  State<ListPage> createState() => _ListPageState();
}

class _ListPageState extends State<ListPage> {
  late SharedPreferences preferences;
  bool isLoading = false;

  @override
  void initState() {
    super.initState();
    getUserData();
  }

  void getUserData() async {
    setState(() {
      isLoading = true;
    });
    preferences = await SharedPreferences.getInstance();
    setState(() {
      isLoading = false;
    });
  }

  Future createJadwal() async {
    int userId = preferences.getInt('user_id') ?? 0;
    String user = userId.toString();
    final String urlj = 'http://127.0.0.1:8000/api/createjadwal?id=$userId';
    var response = await http.get(Uri.parse(urlj));
    var decodedResponse = jsonDecode(response.body);
    var id = decodedResponse['id'];
    print(id); // For example, print it
    return decodedResponse;
  }

  Future getJadwal() async {
    preferences = await SharedPreferences.getInstance();
    int userId = preferences.getInt('user_id') ?? 0;
    String id = userId.toString();
    final String urlj = 'http://localhost:8000/api/auth/getdata?id=' + id;
    var response = await http.get(Uri.parse(urlj));
    var jsonResponse = jsonDecode(response.body);
    return jsonResponse;
  }

  // Future<Map<String, dynamic>> getProfile() async {
  //   int userId = preferences.getInt('user_id') ?? 0;
  //   String user = userId.toString();
  //   final String urlj = 'http://127.0.0.1:8000/api/profilesiswa?id=' + user;
  //   var response = await http.get(Uri.parse(urlj));
  //   if (response.statusCode == 200) {
  //     return jsonDecode(response.body);
  //   } else {
  //     throw Exception('Failed to load profile data');
  //   }
  // }

  void logout() {
    preferences.clear();
    Navigator.of(context).pushReplacement(MaterialPageRoute(
      builder: (context) => LoginPage(),
    ));
  }


  @override
  Widget build(BuildContext context) {
    double baseWidth = 360;
    double fem = MediaQuery.of(context).size.width / baseWidth;
    double ffem = fem * 0.97;
    return Scaffold(
      body: ListView(
        children: [
          Container(
            width: double.infinity,
            child: Container(
              padding: EdgeInsets.fromLTRB(17 * fem, 26 * fem, 13 * fem, 26 * fem),
              width: double.infinity,
              height: 800 * fem,
              decoration: BoxDecoration(
                color: Color(0xffffffff),
              ),
              child: Container(
                width: double.infinity,
                height: 664 * fem,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Container(
                      margin: EdgeInsets.fromLTRB(0 * fem, 0 * fem, 0 * fem, 17.74 * fem),
                      width: double.infinity,
                      height: 28.26 * fem,
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(10 * fem),
                      ),
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Container(
                            margin: EdgeInsets.fromLTRB(0 * fem, 0 * fem, 0 * fem, 0.26 * fem),
                            child: Text(
                              'TB Counseling',
                              style: GoogleFonts.poppins(
                                fontSize: 12 * ffem,
                                fontWeight: FontWeight.w700,
                                height: 1.5 * ffem / fem,
                                letterSpacing: 0.84 * fem,
                                color: Color(0xff4bbbfa),
                              ),
                            ),
                          ),
                          Container(
                            child: Row(
                              children: [
                                // FutureBuilder<Map<String, dynamic>>(
                                //   // future: getProfile(),
                                //   builder: (context, snapshot) {
                                //     if (snapshot.connectionState ==
                                //         ConnectionState.done) {
                                //       if (snapshot.hasError) {
                                //         return Text(
                                //             'Error occurred while fetching profile');
                                //       } else {
                                //         return InkWell(
                                //           onTap: () {
                                //             // Navigate to the Profile page with the fetched data
                                //             Navigator.push(
                                //               context,
                                //               MaterialPageRoute(
                                //                 builder: (context) => ProfilAkun(
                                //                   profile: snapshot.data?['data'],
                                //                 ),
                                //               ),
                                //             );
                                //           },
                                //           child: Container(
                                //             margin: EdgeInsets.fromLTRB(0 * fem, 0 * fem, 3.74 * fem, 0 * fem),
                                //             child: Image.asset(
                                //               'assets/page-1/images/profile.png',
                                //               alignment: Alignment.centerRight,
                                //             ),
                                //           ),
                                //         );
                                //       }
                                //     } else {
                                //       return CircularProgressIndicator();
                                //     }
                                //   },
                                // ),
                                InkWell(
                                  onTap: () {
                                    Navigator.push(
                                      context,
                                      MaterialPageRoute(
                                        builder: (context) => ProfilePage(),
                                      ),
                                    );
                                  },
                                  child: Container(
                                    child: Image.asset(
                                      'assets/page-1/images/profile.png',
                                    ),
                                  ),
                                ),      
                                Container(
                                  child: TextButton(
                                    onPressed: () {},
                                    style: TextButton.styleFrom(
                                      padding: EdgeInsets.zero,
                                    ),
                                    child: InkWell(
                                      onTap: () {
                                        logout();
                                      },
                                      child: Container(
                                        width: 64 * fem,
                                        height: double.infinity,
                                        decoration: BoxDecoration(
                                          color: Color(0xff4bbbfa),
                                          borderRadius: BorderRadius.circular(10 * fem),
                                        ),
                                        child: Center(
                                          child: Text(
                                            'Logout',
                                            style: GoogleFonts.poppins(
                                              fontSize: 10 * ffem,
                                              fontWeight: FontWeight.w400,
                                              height: 1.5 * ffem / fem,
                                              letterSpacing: 0.2 * fem,
                                              color: Color(0xffffffff),
                                            ),
                                          ),
                                        ),
                                      ),
                                    ),
                                  ),
                                ),
                              ],
                            ),
                          )
                        ],
                      ),
                    ),
                    Container(
                      margin: EdgeInsets.fromLTRB(0 * fem, 0 * fem, 0 * fem, 25 * fem),
                      padding: EdgeInsets.fromLTRB(13 * fem, 12 * fem, 13 * fem, 13 * fem),
                      width: double.infinity,
                      height: 159 * fem,
                      decoration: BoxDecoration(
                        color: Color(0xfff3f9ff),
                        borderRadius: BorderRadius.circular(10 * fem),
                      ),
                      child: Container(
                        padding: EdgeInsets.fromLTRB(0 * fem, 5.82 * fem, 3.35 * fem, 5.81 * fem),
                        width: double.infinity,
                        height: double.infinity,
                        child: Row(
                          crossAxisAlignment: CrossAxisAlignment.center,
                          children: [
                            Container(
                              margin: EdgeInsets.fromLTRB(0 * fem, 16.18 * fem, 27.18 * fem, 19.19 * fem),
                              width: 147 * fem,
                              height: double.infinity,
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Container(
                                    margin: EdgeInsets.fromLTRB(0 * fem, 0 * fem, 0 * fem, 4 * fem),
                                    width: double.infinity,
                                    height: 56 * fem,
                                    child: Stack(
                                      children: [
                                        Positioned(
                                          left: 0 * fem,
                                          top: 26 * fem,
                                          child: Align(
                                            child: SizedBox(
                                              width: 147 * fem,
                                              height: 30 * fem,
                                              child: Text(
                                                preferences.getString('namasiswa').toString(),
                                                style: GoogleFonts.poppins(
                                                  fontSize: 20 * ffem,
                                                  fontWeight: FontWeight.w700,
                                                  height: 1.5 * ffem / fem,
                                                  letterSpacing: 0.6 * fem,
                                                  color: Color(0xff4bbbfa),
                                                ),
                                              ),
                                            ),
                                          ),
                                        ),
                                        Positioned(
                                          left: 0 * fem,
                                          top: 0 * fem,
                                          child: Align(
                                            child: SizedBox(
                                              width: 39 * fem,
                                              height: 30 * fem,
                                              child: Text(
                                                'Hi! ',
                                                style: GoogleFonts.poppins(
                                                  fontSize: 20 * ffem,
                                                  fontWeight: FontWeight.w700,
                                                  height: 1.5 * ffem / fem,
                                                  letterSpacing: 1.4 * fem,
                                                  color: Color(0xff4bbbfa),
                                                ),
                                              ),
                                            ),
                                          ),
                                        ),
                                      ],
                                    ),
                                  ),
                                  Container(
                                    constraints: BoxConstraints(
                                      maxWidth: 134 * fem,
                                    ),
                                    child: Text(
                                      'Lihat pertemuanmu dengan Pembimbing Konseling.',
                                      style: GoogleFonts.poppins(
                                        fontSize: 9 * ffem,
                                        fontWeight: FontWeight.w400,
                                        height: 1.5 * ffem / fem,
                                        letterSpacing: 0.18 * fem,
                                        color: Color(0xff73bde6),
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                            ),
                            Container(
                              width: 126.46 * fem,
                              height: 122.37 * fem,
                              child: Image.asset(
                                'assets/page-1/images/image-bg.png',
                                width: 126.46 * fem,
                                height: 122.37 * fem,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                    Container(
                      width: 322 * fem,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Container(
                            child: Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
                              children: [
                                Container(
                                  margin: EdgeInsets.fromLTRB(0 * fem, 0 * fem, 0 * fem, 18 * fem),
                                  child: Text(
                                    'Pertemuanmu :',
                                    style: GoogleFonts.poppins(
                                      fontSize: 15 * ffem,
                                      fontWeight: FontWeight.w700,
                                      height: 1.5 * ffem / fem,
                                      letterSpacing: 0.45 * fem,
                                      color: Color(0xff218ecb),
                                    ),
                                  ),
                                ),
                                FutureBuilder(
                                  future: createJadwal(),
                                  builder: (context, snapshot) {
                                    if (snapshot.connectionState == ConnectionState.done) {
                                      if (snapshot.hasError) {
                                        return Text('Error occurred while fetching profile');
                                      } else {
                                        return InkWell(
                                          onTap: () {
                                            Navigator.push(
                                              context,
                                              MaterialPageRoute(
                                                builder: (context) => JadwalPage(
                                                  jadwal: snapshot.data['data'],
                                                ),
                                              ),
                                            );
                                          },
                                          child: Container(
                                            width: 64 * fem,
                                            height: 28 * fem,
                                            alignment: Alignment.center,
                                            decoration: BoxDecoration(
                                              color: Color(0xff4bbbfa),
                                              borderRadius: BorderRadius.circular(10 * fem),
                                            ),
                                            child: Text(
                                              '+ Jadwal',
                                              style: GoogleFonts.poppins(
                                                fontSize: 10 * ffem,
                                                fontWeight: FontWeight.w400,
                                                height: 1.5 * ffem / fem,
                                                letterSpacing: 0.2 * fem,
                                                color: Color(0xffffffff),
                                              ),
                                            ),
                                          ),
                                        );
                                      }
                                    } else {
                                      return CircularProgressIndicator();
                                    }
                                  },
                                ),
                              ],
                            ),
                          ),
                          Container(
                            margin: EdgeInsets.only(top: 5 * fem),
                            width: double.infinity,
                            height: MediaQuery.of(context).size.height / 2,
                            child: FutureBuilder(
                              future: getJadwal(),
                              builder: (context, snapshot) {
                                if (snapshot.connectionState == ConnectionState.waiting) {
                                  return Center(
                                    child: CircularProgressIndicator(),
                                  );
                                } else if (snapshot.hasError) {
                                  return Center(
                                    child: Text('Error occurred while fetching data'),
                                  );
                                } else {
                                  List<dynamic> jadwalList = snapshot.data['data'];
                                  return ListView.builder(
                                    physics: const ClampingScrollPhysics(),
                                    itemCount: jadwalList.length,
                                    itemBuilder: (context, index) {
                                      var jadwal = jadwalList[index];
                                      return InkWell(
                                        onTap: () {
                                          Navigator.push(
                                            context,
                                            MaterialPageRoute(
                                              builder: (context) => DetailPage(
                                                jadwal: jadwal,
                                              ),
                                            ),
                                          );
                                        },
                                        child: Container(
                                          margin: EdgeInsets.only(bottom: 20),
                                          width: double.infinity,
                                          height: 65 * fem,
                                          child: Stack(
                                            children: [
                                              Positioned(
                                                left: 0 * fem,
                                                top: 21 * fem,
                                                child: Container(
                                                  padding: EdgeInsets.fromLTRB(8 * fem, 21 * fem, 8 * fem, 9 * fem),
                                                  width: 322 * fem,
                                                  height: 44 * fem,
                                                  decoration: BoxDecoration(
                                                    border: Border.all(color: Color(0xff4bbbfa)),
                                                    color: Color(0xffffffff),
                                                    borderRadius: BorderRadius.only(
                                                      bottomRight: Radius.circular(5 * fem),
                                                      bottomLeft: Radius.circular(5 * fem),
                                                    ),
                                                  ),
                                                  child: Row(
                                                    children: [
                                                      Text(
                                                        jadwal['waktu'],
                                                        style: GoogleFonts.poppins(
                                                          fontSize: 9 * ffem,
                                                          fontWeight: FontWeight.w400,
                                                          height: 1.5 * ffem / fem,
                                                          letterSpacing: 0.18 * fem,
                                                          color: Color(0xff115a83),
                                                        ),
                                                      ),
                                                      Text(
                                                        ', di ${jadwal['tempat']}',
                                                        style: GoogleFonts.poppins(
                                                          fontSize: 9 * ffem,
                                                          fontWeight: FontWeight.w400,
                                                          height: 1.5 * ffem / fem,
                                                          letterSpacing: 0.18 * fem,
                                                          color: Color(0xff115a83),
                                                        ),
                                                      ),
                                                    ],
                                                  ),
                                                ),
                                              ),
                                              Positioned(
                                                left: 0 * fem,
                                                top: 0 * fem,
                                                child: Container(
                                                  padding: EdgeInsets.fromLTRB(8 * fem, 8 * fem, 8 * fem, 8 * fem),
                                                  width: 322 * fem,
                                                  height: 34 * fem,
                                                  decoration: BoxDecoration(
                                                    border: Border.all(color: Color(0xffcad5ea)),
                                                    color: Color(0xff4bbbfa),
                                                    borderRadius: BorderRadius.only(
                                                      topLeft: Radius.circular(5 * fem),
                                                      topRight: Radius.circular(5 * fem),
                                                    ),
                                                  ),
                                                  child: Container(
                                                    width: double.infinity,
                                                    height: double.infinity,
                                                    child: Row(
                                                      crossAxisAlignment: CrossAxisAlignment.center,
                                                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                                                      children: [
                                                        Text(
                                                          '${jadwal['layanan_bk']['jenis_layanan'] ?? ''}',
                                                          style: GoogleFonts.poppins(
                                                            fontSize: 12 * ffem,
                                                            fontWeight: FontWeight.w600,
                                                            height: 1.5 * ffem / fem,
                                                            color: Color(0xffffffff),
                                                          ),
                                                        ),
                                                        Text(
                                                          jadwal['status'],
                                                          style: GoogleFonts.poppins(
                                                            fontSize: 12 * ffem,
                                                            fontWeight: FontWeight.w600,
                                                            height: 1.5 * ffem / fem,
                                                            color: Color(0xffffffff),
                                                          ),
                                                        ),
                                                      ],
                                                    ),
                                                  ),
                                                ),
                                              ),
                                            ],
                                          ),
                                        ),
                                      );
                                    },
                                  );
                                }
                              },
                            ),
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
