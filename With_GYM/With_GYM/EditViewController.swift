//
//  EditViewController.swift
//  With_GYM
//
//  Created by 김용우 on 2017. 11. 13..
//  Copyright © 2017년 김용우. All rights reserved.
//

import UIKit

class EditViewController: UIViewController, UIPickerViewDelegate, UIPickerViewDataSource, UIWebViewDelegate, UINavigationControllerDelegate {

    //Pick item
    let pickJobOption = ["학생", "교직원"]
    let pickPeriodOption = ["1달", "2달", "3달", "학기"]
    
    @IBOutlet weak var tfName: UITextField!
    @IBOutlet weak var tfJob: UITextField!
    @IBOutlet weak var tfMajor: UITextField!
    @IBOutlet weak var tfNumber: UITextField!
    @IBOutlet weak var tfPhone: UITextField!
    @IBOutlet weak var tfPeriod: UITextField!
    
    @IBOutlet weak var btnInit: UIButton!
    @IBOutlet weak var btnApply: UIButton!
    
    @IBOutlet weak var subWebView: UIWebView!
    
    override func viewDidLoad() {
        super.viewDidLoad()

        //PickerView
        let jobPicker = UIPickerView()
        let periodPicker = UIPickerView()
        
        jobPicker.delegate = self
        jobPicker.tag = 1
        periodPicker.delegate = self
        periodPicker.tag = 2
        
        tfJob.inputView = jobPicker
        tfPeriod.inputView = periodPicker
        
        //버튼모양 둥글게
        btnInit.layer.cornerRadius  = 10.0
        btnApply.layer.cornerRadius = 10.0
        
        //webView
        let uuid = UIDevice.current.identifierForVendor
        CommonString.deviceID = String(describing: uuid!)
        
        //webViewIndicator.isHidden = true
        subWebView.delegate = self
        
        currentStateReq()
    }

    //MARK: ------------------------------------------------------------------------- MainView UI
    //MARK: --------------------------------------- Pickerview data source
    func numberOfComponents(in pickerView: UIPickerView) -> Int {
        return 1
    }
    func pickerView(_ pickerView: UIPickerView, numberOfRowsInComponent component: Int) -> Int {
        if pickerView.tag == 1 {return pickJobOption.count}
        else if pickerView.tag == 2 {return pickPeriodOption.count}
        return 0
    }
    func pickerView(_ pickerView: UIPickerView, titleForRow row: Int, forComponent component: Int) -> String? {
        if pickerView.tag == 1 {return pickJobOption[row]}
        else if pickerView.tag == 2 {return pickPeriodOption[row]}
        return nil
    }
    func pickerView(_ pickerView: UIPickerView, didSelectRow row: Int, inComponent component: Int) {
        if pickerView.tag == 1 {tfJob.text = pickJobOption[row]}
        else if pickerView.tag == 2 {tfPeriod.text = pickPeriodOption[row]}
    }
    override func touchesBegan(_ touches: Set<UITouch>, with event: UIEvent?) {
        view.endEditing(true)
    }
    
    //MARK: ------------------------------------------------------------------------- MainView Action
    @IBAction func btnInitTextField(_ sender: UIButton) {   //초기화 버튼
        tfName.text = ""
        tfJob.text = ""
        tfMajor.text = ""
        tfNumber.text = ""
        tfPhone.text = ""
        tfPeriod.text = ""
        
        NSLog("입력정보 초기화")
    }
    @IBAction func btnApply(_ sender: UIButton) {   //수정하기 버튼
        NSLog("수정하기 버튼")
        var msg = ""
        var alertQuarter = true
        
        if tfName.text == ""  {
            msg = "이름을 입력해주세요"
        } else if tfJob.text == "" || !(tfJob.text == "학생" || tfJob.text == "교직원") {
            if tfJob.text == "" {
                msg = "직업을 입력해주세요"
            } else {
                msg = "'학생' 또는 '교직원'으로 입력해주세요"
            }
        } else if tfMajor.text == "" {
            msg = "소속을 입력해주세요"
        } else if tfNumber.text == "" {
            msg = "학번 또는 사번을 입력해주세요"
        } else if tfPhone.text == "" {
            msg = "연락처을 입력해주세요"
        } else if tfPeriod.text == "" || !(tfPeriod.text == "1달" || tfPeriod.text == "2달" || tfPeriod.text == "3달" || tfPeriod.text == "학기") {
            if tfPeriod.text == "" {
                msg = "기간을 입력해주세요"
            } else {
                msg = "'1/2/3달' 또는 '학기'로 입력해주세요"
            }
        } else {
            alertQuarter = false
            let lastCheck = "인적사항이 불명확할 경우\n회원접수가 보류 될 수 있습니다.\n\n\(tfName.text!)\n\(tfJob.text!)\n\(tfMajor.text!)\n\(tfNumber.text!)\n\(tfPhone.text!)\n\(tfPeriod.text!)\n"
            let alert = UIAlertController(title: "수정할 정보확인", message: lastCheck, preferredStyle: .alert)
            let applyAction = UIAlertAction(title: "수정하기", style: .default) {(action: UIAlertAction!) -> Void in
                
                self.acceptRequest()
            }
            let reInputAction = UIAlertAction(title: "다시 작성하기", style: .default) { (action:UIAlertAction!) -> Void in
            }
            alert.addAction(applyAction)
            alert.addAction(reInputAction)
            
            present(alert, animated: true, completion:nil)
        }
        if alertQuarter == true {
            let alert = UIAlertController(title: "수정불가", message: msg, preferredStyle: .alert)
            let confirmAction = UIAlertAction(title: "확인", style: .default) {(action: UIAlertAction!) -> Void in
                NSLog(msg)
            }
            
            alert.addAction(confirmAction)
            
            present(alert, animated: true, completion:nil)
            NSLog("입력실패")
        } else {
            NSLog("입력성공")
        }
    }
    func acceptRequest() {
        personalInformation[0] = tfName.text!
        personalInformation[1] = tfJob.text!
        personalInformation[2] = tfMajor.text!
        personalInformation[3] = tfNumber.text!
        personalInformation[4] = tfPhone.text!
        personalInformation[5] = tfPeriod.text!
        
        //데이터 체크
        NSLog("데이터 체크")
        
        let encoded = [personalInformation[0].addingPercentEncoding(withAllowedCharacters: .urlHostAllowed)!, personalInformation[1].addingPercentEncoding(withAllowedCharacters: .urlHostAllowed)!, personalInformation[2].addingPercentEncoding(withAllowedCharacters: .urlHostAllowed)!, personalInformation[3].addingPercentEncoding(withAllowedCharacters: .urlHostAllowed)!, personalInformation[4].addingPercentEncoding(withAllowedCharacters: .urlHostAllowed)!, personalInformation[5].addingPercentEncoding(withAllowedCharacters: .urlHostAllowed)!]
        
        let url = "\(CommonString.editFullURL)&name=\(encoded[0])&job=\(encoded[1])&major=\(encoded[2])&number=\(encoded[3])&phone=\(encoded[4])&period=\(encoded[5])"
        NSLog(url)
        
        subWebView?.loadRequest(URLRequest(url: URL(string: url)!))
    }
    
    //MARK: --------------------------------------- WebView Method
    func currentStateReq() {
        let url = "\(CommonString.editReqFullURL)"
        NSLog(url)
        subWebView?.loadRequest(URLRequest(url: URL(string: url)!))
    }
    func webView(_ webView: UIWebView, shouldStartLoadWith request: URLRequest, navigationType: UIWebViewNavigationType) -> Bool {
        NSLog("JS -> 아이폰")
        if let s = request.url?.absoluteString {
            if s.hasPrefix("js:"){
                var array = s.components(separatedBy: "://")
                let customFunction = array[1] // array[0] value is 'js'
                
                let list = customFunction.components(separatedBy: "?")
                let funcName = String(describing: list[0])
                
                var name     = "dump"
                var job      = "dump"
                var major    = "dump"
                var number   = "dump"
                var phone    = "dump"
                var period   = "dump"
                
                if funcName == "dataResponse" {
                    name     = String(describing: list[1]).removingPercentEncoding!
                    job      = String(describing: list[2]).removingPercentEncoding!
                    major    = String(describing: list[3]).removingPercentEncoding!
                    number   = String(describing: list[4])
                    phone    = String(describing: list[5])
                    period   = String(describing: list[6]).removingPercentEncoding!
                } else {
                }
                
                switch(funcName){
                case "requestDone" :
                    requestDone(true)
                    break
                case "requestFail" :
                    requestDone(false)
                    break
                case "dataResponse" :
                    dataResponse(name, job, major, number, phone, period)
                    break
                default:
                    break
                }
                return false
            }
        }
        return true
    }
    func requestDone(_ result: Bool) {
        NSLog("정보수정 결과")
        if result == true {
            let alert = UIAlertController(title: "정보수정완료", message: "회원정보 수정이 완료되었습니다.", preferredStyle: .alert)
            let confirmAction = UIAlertAction(title: "확인", style: .default) {(action: UIAlertAction!) -> Void in
                //정보수정
                apply = true
                
                self.navigationController?.popToRootViewController(animated: true)
            }
            
            alert.addAction(confirmAction)
            present(alert, animated: true, completion:nil)
        } else {
            let alert = UIAlertController(title: "수정불가", message: "회원정보 업데이트 도도중 문제가 발생했습니다.", preferredStyle: .alert)
            let confirmAction = UIAlertAction(title: "확인", style: .default) {(action: UIAlertAction!) -> Void in
            }
            
            alert.addAction(confirmAction)
            present(alert, animated: true, completion:nil)
        }
    }
    func dataResponse(_ name:String, _ job:String,_ major:String, _ number:String, _ phone:String, _ period:String) {
        NSLog("텍스트박스 채우기")
        tfName.text     = name
        tfJob.text      = job
        tfMajor.text    = major
        tfNumber.text   = number
        tfPhone.text    = phone
        tfPeriod.text   = period
    }
}
