import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter/gestures.dart';
import 'dart:ui';
import 'package:google_fonts/google_fonts.dart';
import 'package:myapp/pages/detai-pertemuan.dart';
import 'package:myapp/pages/login.dart';
import 'package:page_transition/page_transition.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:http/http.dart' as http;
import 'package:snapshot/snapshot.dart';

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
    getJadwal();
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

  Future getJadwal() async {
    preferences = await SharedPreferences.getInstance();

    int userId = preferences.getInt('user_id') ?? 0;
    String id = userId.toString();
    final String urlj = 'http://localhost:8000/api/auth/getdata?id=' + id; 
    var response = await http.get(Uri.parse(urlj));
    var jsonRespone = jsonDecode(response.body);
    // return print(jsonRespone);
    return jsonRespone;
  }

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
              // listviewpertemuanvHC (20:852)
              padding:
                  EdgeInsets.fromLTRB(17 * fem, 26 * fem, 13 * fem, 26 * fem),
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
                      margin: EdgeInsets.fromLTRB(
                          0 * fem, 0 * fem, 0 * fem, 17.74 * fem),
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
                            margin: EdgeInsets.fromLTRB(
                                0 * fem, 0 * fem, 0 * fem, 0.26 * fem),
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
                                Container(
                                  margin: EdgeInsets.fromLTRB(
                                      0 * fem, 0 * fem, 3.74 * fem, 0 * fem),
                                  child: Image.asset(
                                    'assets/page-1/images/profile.png',
                                    alignment: Alignment.centerRight,
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
                                          borderRadius:
                                              BorderRadius.circular(10 * fem),
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
                      margin: EdgeInsets.fromLTRB(
                          0 * fem, 0 * fem, 0 * fem, 25 * fem),
                      padding: EdgeInsets.fromLTRB(
                          13 * fem, 12 * fem, 13 * fem, 13 * fem),
                      width: double.infinity,
                      height: 159 * fem,
                      decoration: BoxDecoration(
                        color: Color(0xfff3f9ff),
                        borderRadius: BorderRadius.circular(10 * fem),
                      ),
                      child: Container(
                        padding: EdgeInsets.fromLTRB(
                            0 * fem, 5.82 * fem, 3.35 * fem, 5.81 * fem),
                        width: double.infinity,
                        height: double.infinity,
                        child: Row(
                          crossAxisAlignment: CrossAxisAlignment.center,
                          children: [
                            Container(
                              margin: EdgeInsets.fromLTRB(0 * fem, 16.18 * fem,
                                  27.18 * fem, 19.19 * fem),
                              width: 147 * fem,
                              height: double.infinity,
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Container(
                                    margin: EdgeInsets.fromLTRB(
                                        0 * fem, 0 * fem, 0 * fem, 4 * fem),
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
                                                // 'Septheaaaaa',
                                                preferences
                                                    .getString('namasiswa')
                                                    .toString(),
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
                                      'Lihat pertemuan mu dengen Pembimbing Konseling.',
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
                            margin: EdgeInsets.fromLTRB(
                                0 * fem, 0 * fem, 0 * fem, 18 * fem),
                            child: Text(
                              'Pertemuena mu :',
                              style: GoogleFonts.poppins(
                                fontSize: 15 * ffem,
                                fontWeight: FontWeight.w700,
                                height: 1.5 * ffem / fem,
                                letterSpacing: 0.45 * fem,
                                color: Color(0xff218ecb),
                              ),
                            ),
                          ),
                          Container(
                            width: double.infinity,
                            // color: Colors.amber,
                            height: MediaQuery.of(context).size.height / 2,
                            child: FutureBuilder(
                                future: getJadwal(),
                                builder: (context, snapshot) {
                                  if (snapshot.hasData) {
                                    return ListView.builder(
                                      physics: const ClampingScrollPhysics(),
                                      itemCount: snapshot.data['data'].length,
                                      itemBuilder: (context, index) {
                                        return InkWell(
                                          onTap: () {
                                            Navigator.push(
                                              context,
                                              MaterialPageRoute(
                                                  builder: (context) =>
                                                      DetailPage(
                                                        jadwal: snapshot
                                                                .data['data']
                                                            [index],
                                                      )),
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
                                                    padding:
                                                        EdgeInsets.fromLTRB(
                                                            8 * fem,
                                                            21 * fem,
                                                            8 * fem,
                                                            9 * fem),
                                                    width: 322 * fem,
                                                    height: 44 * fem,
                                                    decoration: BoxDecoration(
                                                      border: Border.all(
                                                          color: Color(
                                                              0xff4bbbfa)),
                                                      color: Color(0xffffffff),
                                                      borderRadius:
                                                          BorderRadius.only(
                                                        bottomRight:
                                                            Radius.circular(
                                                                5 * fem),
                                                        bottomLeft:
                                                            Radius.circular(
                                                                5 * fem),
                                                      ),
                                                    ),
                                                    child: Row(
                                                      children: [
                                                        Text(
                                                          snapshot.data['data']
                                                              [index]['waktu'],
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 9 * ffem,
                                                            fontWeight:
                                                                FontWeight.w400,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.18 * fem,
                                                            color: Color(
                                                                0xff115a83),
                                                          ),
                                                        ),
                                                        Text(
                                                          ', di ${snapshot.data['data'][index]['tempat']}',
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 9 * ffem,
                                                            fontWeight:
                                                                FontWeight.w400,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.18 * fem,
                                                            color: Color(
                                                                0xff115a83),
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
                                                    padding:
                                                        EdgeInsets.fromLTRB(
                                                            8 * fem,
                                                            8 * fem,
                                                            8 * fem,
                                                            8 * fem),
                                                    width: 322 * fem,
                                                    height: 34 * fem,
                                                    decoration: BoxDecoration(
                                                      border: Border.all(
                                                          color: Color(
                                                              0xffcad5ea)),
                                                      color: Color(0xff4bbbfa),
                                                      borderRadius:
                                                          BorderRadius.only(
                                                        topLeft:
                                                            Radius.circular(
                                                                5 * fem),
                                                        topRight:
                                                            Radius.circular(
                                                                5 * fem),
                                                      ),
                                                    ),
                                                    child: Container(
                                                      width: double.infinity,
                                                      height: double.infinity,
                                                      child: Row(
                                                        crossAxisAlignment:
                                                            CrossAxisAlignment
                                                                .center,
                                                        mainAxisAlignment:
                                                            MainAxisAlignment
                                                                .spaceBetween,
                                                        children: [
                                                          Text(
                                                            snapshot.data['data']
                                                                        [index][
                                                                    'layanan_bk']
                                                                [
                                                                'jenis_layanan'],
                                                            style: GoogleFonts
                                                                .poppins(
                                                              fontSize:
                                                                  12 * ffem,
                                                              fontWeight:
                                                                  FontWeight
                                                                      .w600,
                                                              height: 1.5 *
                                                                  ffem /
                                                                  fem,
                                                              color: Color(
                                                                  0xffffffff),
                                                            ),
                                                          ),
                                                          Text(
                                                            snapshot.data[
                                                                        'data']
                                                                    [index]
                                                                ['status'],
                                                            style: GoogleFonts
                                                                .poppins(
                                                              fontSize:
                                                                  12 * ffem,
                                                              fontWeight:
                                                                  FontWeight
                                                                      .w600,
                                                              height: 1.5 *
                                                                  ffem /
                                                                  fem,
                                                              color: Color(
                                                                  0xffffffff),
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
                                  } else {
                                    return Center(
                                      child: CircularProgressIndicator(),
                                    );
                                  }
                                }),
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
