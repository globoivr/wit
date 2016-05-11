import java.nio.file.{Files, Paths}

import scalaj.http.Http
import scala.io.Source
import java.io.File

object Main {

  val TOKEN = "ZVZ2WWQ6VUWKQKK6TFBCEH2WPD5KLQW6"

  def sanitize: Set[String] = {
    val l = Source.fromFile("languages.txt").getLines()
    val cleaned = l map { str =>
      val idx = str.indexOf("(")
      str.substring(0, if (idx != -1) idx else str.length).replaceAll("\"", "").trim().toUpperCase()
    }
    cleaned.toSet

  }

  // Somehow, wit.ai has already deprecated this.  These new to be created by hand as 'traits', as of 5-4-2016
  // DEPRECATED
  @deprecated
  def submitLanguages() = {
    val languages = sanitize
    languages.foreach(l => {
      val lower = l.toLowerCase
      val body =
        s"""
           |{"name": "${l}",
           | "doc":"${l}",
           | "expressions":[{
           | "body" : "${lower}"
           |        }]}
           """.stripMargin

      print(s"Creating ${l} = ")

      val resp = Http("https://api.wit.ai/intents?v=20141022").postData(body).
        header("Authorization", s"Bearer ${TOKEN}").
        header("Content-Type", "application/json").asString
      println(resp)

    })
  }

  def submitSamples() = {


    val files = new File("audio/raw/charlie").listFiles.filter(_.isFile).toList

    files.foreach(file => {

      println(s"Submitting ${file.toPath} ")

      val byteArray = Files.readAllBytes(file.toPath)
      val resp = Http("https://api.wit.ai/speech?v=20141022").postData(byteArray).
        header("Authorization", s"Bearer ${TOKEN}").
        header("Content-Type", "audio/wav").asString


      println(resp)
    })


  }

  def main(args: Array[String]): Unit = {
    submitSamples()

  }

}
