import 'package:flutter/material.dart';
import 'package:flutter/gestures.dart';
import 'dart:ui';
import 'package:google_fonts/google_fonts.dart';
import 'package:myapp/pages/list-view-pertemuan.dart';
import 'package:page_transition/page_transition.dart';

class DetailPage extends StatelessWidget {
  final Map jadwal;

  DetailPage({super.key, required this.jadwal});

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
              padding:
                  EdgeInsets.fromLTRB(0 * fem, 26 * fem, 0 * fem, 26 * fem),
              width: double.infinity,
              height: 800 * fem,
              decoration: BoxDecoration(
                color: Color(0xffffffff),
              ),
              child: Container(
                width: double.infinity,
                height: 518 * fem,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    Container(
                      margin: EdgeInsets.fromLTRB(
                          15 * fem, 0 * fem, 14.74 * fem, 17.74 * fem),
                      width: double.infinity,
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(10 * fem),
                      ),
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          Container(
                            margin: EdgeInsets.fromLTRB(
                                0 * fem, 0 * fem, 203 * fem, 0.26 * fem),
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
                            child: Image.asset(
                              'assets/page-1/images/profile.png',
                            ),
                          ),
                        ],
                      ),
                    ),
                    Container(
                      width: double.infinity,
                      height: 472 * fem,
                      child: Stack(
                        children: [
                          Positioned(
                            left: 0 * fem,
                            top: 0 * fem,
                            child: Container(
                              padding: EdgeInsets.fromLTRB(
                                  20 * fem, 20 * fem, 20 * fem, 20 * fem),
                              width: 360 * fem,
                              height: 253 * fem,
                              decoration: BoxDecoration(
                                color: Color(0xfff3f9ff),
                              ),
                              child: Container(
                                padding: EdgeInsets.fromLTRB(2.39 * fem,
                                    5.82 * fem, 3.35 * fem, 5.81 * fem),
                                width: double.infinity,
                                height: 134 * fem,
                                child: Row(
                                  crossAxisAlignment: CrossAxisAlignment.center,
                                  children: [
                                    InkWell(
                                      onTap: () {
                                        Navigator.push(
                                            context,
                                            MaterialPageRoute(
                                                builder: (context) =>
                                                    ListPage()));
                                      },
                                      child: Container(
                                        margin: EdgeInsets.fromLTRB(0 * fem,
                                            0 * fem, 5.17 * fem, 61.01 * fem),
                                        width: 8.44 * fem,
                                        height: 8.22 * fem,
                                        child: Image.asset(
                                          'assets/page-1/images/back.png',
                                          width: 8.44 * fem,
                                          height: 8.22 * fem,
                                        ),
                                      ),
                                    ),
                                    Container(
                                      margin: EdgeInsets.fromLTRB(
                                          0 * fem,
                                          16.18 * fem,
                                          12.18 * fem,
                                          19.19 * fem),
                                      height: double.infinity,
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          Container(
                                            margin:
                                                EdgeInsets.only(top: 5 * ffem),
                                            constraints: BoxConstraints(
                                              maxWidth: 127 * fem,
                                            ),
                                            child: Text(
                                              'Detail\nBimbingan',
                                              style: GoogleFonts.poppins(
                                                fontSize: 20 * ffem,
                                                fontWeight: FontWeight.w700,
                                                height: 1.5 * ffem / fem,
                                                letterSpacing: 1.4 * fem,
                                                color: Color(0xff4bbbfa),
                                              ),
                                            ),
                                          ),
                                          Container(
                                            constraints: BoxConstraints(
                                              maxWidth: 162 * fem,
                                            ),
                                            child: Text(
                                              'Lihat detail bimbingan mu dengen Pembimbing Konseling.',
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
                                      transform: Matrix4.translationValues(
                                          0.0, -40 * ffem, 0.0),
                                      width: 126.46 * fem,
                                      height: 122.37 * fem,
                                      child: Image.asset(
                                        'assets/page-1/images/image-bg2.png',
                                        width: 126.46 * fem,
                                        height: 122.37 * fem,
                                      ),
                                    ),
                                  ],
                                ),
                              ),
                            ),
                          ),
                          Positioned(
                            left: 30 * fem,
                            top: 179 * fem,
                            child: Container(
                              width: 300 * fem,
                              height: 293 * fem,
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(15 * fem),
                              ),
                              child: Container(
                                padding: EdgeInsets.fromLTRB(
                                    28 * fem, 25 * fem, 3 * fem, 55.41 * fem),
                                width: double.infinity,
                                height: double.infinity,
                                decoration: BoxDecoration(
                                  color: Color(0xffffffff),
                                  borderRadius: BorderRadius.circular(15 * fem),
                                  boxShadow: [
                                    BoxShadow(
                                      color: Color(0xfff2f2ff),
                                      offset: Offset(0 * fem, 1 * fem),
                                      blurRadius: 15 * fem,
                                    ),
                                  ],
                                ),
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.center,
                                  children: [
                                    Container(
                                      margin: EdgeInsets.fromLTRB(0 * fem,
                                          0 * fem, 100 * fem, 10 * fem),
                                      child: Text(
                                        'Detail bimbingan ',
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
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          Container(
                                            padding: EdgeInsets.fromLTRB(
                                                0 * fem,
                                                0 * fem,
                                                0 * fem,
                                                14.39 * fem),
                                            width: double.infinity,
                                            child: Column(
                                              crossAxisAlignment:
                                                  CrossAxisAlignment.start,
                                              children: [
                                                
                                                Container(
                                                  margin: EdgeInsets.fromLTRB(
                                                      0 * fem,
                                                      0 * fem,
                                                      0 * fem,
                                                      14.64 * fem),
                                                  child: Row(
                                                    crossAxisAlignment:
                                                        CrossAxisAlignment
                                                            .center,
                                                    children: [
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0 * fem,
                                                                45 * fem,
                                                                0 * fem),
                                                        child: Text(
                                                          'Nama Siswa',
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0 * fem,
                                                                15 * fem,
                                                                0 * fem),
                                                        child: Text(
                                                          ':',
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                      Text(
                                                        jadwal['siswa']
                                                            ['namasiswa'],
                                                        style:
                                                            GoogleFonts.poppins(
                                                          fontSize: 11 * ffem,
                                                          fontWeight:
                                                              FontWeight.w500,
                                                          height:
                                                              1.5 * ffem / fem,
                                                          letterSpacing:
                                                              0.33 * fem,
                                                          color:
                                                              Color(0xff218ecb),
                                                        ),
                                                      ),
                                                    ],
                                                  ),
                                                ),
                                                

                                                Container(
                                                  margin: EdgeInsets.fromLTRB(
                                                      0 * fem,
                                                      0 * fem,
                                                      0 * fem,
                                                      14.64 * fem),
                                                  child: Row(
                                                    crossAxisAlignment:
                                                        CrossAxisAlignment
                                                            .center,
                                                    children: [
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0 * fem,
                                                                20 * fem,
                                                                0 * fem),
                                                        child: Text(
                                                          'Jenis Bimbingan',
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0 * fem,
                                                                15 * fem,
                                                                0 * fem),
                                                        child: Text(
                                                          ':',
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                      Text(
                                                        jadwal['layanan_bk']
                                                            ['jenis_layanan'],
                                                        style:
                                                            GoogleFonts.poppins(
                                                          fontSize: 11 * ffem,
                                                          fontWeight:
                                                              FontWeight.w500,
                                                          height:
                                                              1.5 * ffem / fem,
                                                          letterSpacing:
                                                              0.33 * fem,
                                                          color:
                                                              Color(0xff218ecb),
                                                        ),
                                                      ),
                                                    ],
                                                  ),
                                                ),
                                                

                                                
                                                Container(
                                                  margin: EdgeInsets.fromLTRB(
                                                      0 * fem,
                                                      0 * fem,
                                                      0 * fem,
                                                      14.55 * fem),
                                                  child: Row(
                                                    crossAxisAlignment:
                                                        CrossAxisAlignment
                                                            .center,
                                                    children: [
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0.08 * fem,
                                                                5 * fem,
                                                                0 * fem),
                                                        child: Text(
                                                          'Nama Pembimbing',
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0.08 * fem,
                                                                15 * fem,
                                                                0 * fem),
                                                        child: Text(
                                                          ':',
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0 * fem,
                                                                0 * fem,
                                                                0.08 * fem),
                                                        child: Text(
                                                          jadwal['guru']['namaguru'],
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                    ],
                                                  ),
                                                ),
                                                Container(
                                                  margin: EdgeInsets.fromLTRB(
                                                      0 * fem,
                                                      0 * fem,
                                                      0 * fem,
                                                      14.47 * fem),
                                                  child: Row(
                                                    crossAxisAlignment:
                                                        CrossAxisAlignment
                                                            .center,
                                                    children: [
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0.16 * fem,
                                                                77 * fem,
                                                                0 * fem),
                                                        child: Text(
                                                          'Waktu',
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0.16 * fem,
                                                                15 * fem,
                                                                0 * fem),
                                                        child: Text(
                                                          ':',
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0 * fem,
                                                                0 * fem,
                                                                0.16 * fem),
                                                        child: Text(
                                                          jadwal['waktu'],
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                    ],
                                                  ),
                                                ),
                                                Container(
                                                  child: Row(
                                                    crossAxisAlignment:
                                                        CrossAxisAlignment
                                                            .center,
                                                    children: [
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0.25 * fem,
                                                                70 * fem,
                                                                0 * fem),
                                                        child: Text(
                                                          'Tempat',
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0.25 * fem,
                                                                15 * fem,
                                                                0 * fem),
                                                        child: Text(
                                                          ':',
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                      Container(
                                                        margin:
                                                            EdgeInsets.fromLTRB(
                                                                0 * fem,
                                                                0 * fem,
                                                                0 * fem,
                                                                0.25 * fem),
                                                        child: Text(
                                                          jadwal['tempat'],
                                                          style: GoogleFonts
                                                              .poppins(
                                                            fontSize: 11 * ffem,
                                                            fontWeight:
                                                                FontWeight.w500,
                                                            height: 1.5 *
                                                                ffem /
                                                                fem,
                                                            letterSpacing:
                                                                0.33 * fem,
                                                            color: Color(
                                                                0xff218ecb),
                                                          ),
                                                        ),
                                                      ),
                                                    ],
                                                  ),
                                                ),
                                              ],
                                            ),
                                          ),
                                          
                                          Container(
                                            child: Row(
                                              crossAxisAlignment:
                                                  CrossAxisAlignment.center,
                                              children: [
                                                Container(
                                                  margin: EdgeInsets.fromLTRB(
                                                      0 * fem,
                                                      0.41 * fem,
                                                      77 * fem,
                                                      0 * fem),
                                                  child: Text(
                                                    'Status',
                                                    style: GoogleFonts.poppins(
                                                      fontSize: 11 * ffem,
                                                      fontWeight:
                                                          FontWeight.w500,
                                                      height: 1.5 * ffem / fem,
                                                      letterSpacing: 0.33 * fem,
                                                      color: Color(0xff218ecb),
                                                    ),
                                                  ),
                                                ),
                                                Container(
                                                  margin: EdgeInsets.fromLTRB(
                                                      0 * fem,
                                                      0.41 * fem,
                                                      16 * fem,
                                                      0 * fem),
                                                  child: Text(
                                                    ':',
                                                    style: GoogleFonts.poppins(
                                                      fontSize: 11 * ffem,
                                                      fontWeight:
                                                          FontWeight.w500,
                                                      height: 1.5 * ffem / fem,
                                                      letterSpacing: 0.33 * fem,
                                                      color: Color(0xff218ecb),
                                                    ),
                                                  ),
                                                ),
                                                Container(
                                                  margin: EdgeInsets.fromLTRB(
                                                      0 * fem,
                                                      0 * fem,
                                                      0 * fem,
                                                      0.41 * fem),
                                                  child: Text(
                                                    jadwal['status'],
                                                    style: GoogleFonts.poppins(
                                                      fontSize: 11 * ffem,
                                                      fontWeight:
                                                          FontWeight.w500,
                                                      height: 1.5 * ffem / fem,
                                                      letterSpacing: 0.33 * fem,
                                                      color: Color(0xff218ecb),
                                                    ),
                                                  ),
                                                ),
                                              ],
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
