// main.dart

import 'package:flutter/material.dart';
import 'package:myapp/pages/splash-screen.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:myapp/pages/login.dart';
import 'package:myapp/pages/list-view-pertemuan.dart';

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flutter',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: FutureBuilder<SharedPreferences>(
        future: SharedPreferences.getInstance(),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return Center(
              child: CircularProgressIndicator(),
            );
          } else if (snapshot.hasError) {
            return Text('Some error has Occurred');
          } else if (snapshot.hasData) {
            final preferences = snapshot.data;
            return SplashScreen1(); // Kirim instance SharedPreferences ke ListPage.
          } else {
            return LoginPage();
          }
        },
      ),
    );
  }
}

